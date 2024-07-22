<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Http\Resources\ParentProductResource;
use App\Models\Catalogs\Availability;
use App\Models\Catalogs\ProductType;
use App\Models\Catalogs\Status;
use App\Models\Resources\CatalogSection;
use App\Models\Resources\Product;
use App\Models\Resources\SectionProduct;
use App\Models\Result;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ProductController extends Controller implements ResourceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {



            $oProduct = Product::firstOrCreate($request->all());

            return Result::make(Result::OK, $oProduct);

        } catch (QueryException|ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\Product  $product
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function show(Product $product)
    {

        $oProduct = Product::with([
            "type",
            "features",
//            "galleries.items",
            "price",
            "specifications",
            "links",
            "parent",
        ])->get()->find($product);

        return Inertia::render('Products/Edit', [
            'product' => $oProduct,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        try{
            $product->fill($request->get("product"));

            $product->save();

            return Result::make(Result::OK, $product);
        } catch (ModelNotFoundException|QueryException $e){
            return Result::make(Result::ERROR, $e->errors());
        }
    }


    public function store_picture(Request $request, int $product){
        $oProduct = Product::where("id", $product)->first();
        return $oProduct->upload_image($request, "product");
    }

//    public function store_picture(Request $request, int $product){
//        $request->validate([
//            'picture' => 'required|file|image|max:2048',
//        ]);
//
//        try {
//
//            $oProduct = Product::where("id", $product)->first();
//            if($request->file("picture")) {
//                $fileName = auth()->user()->id."_".time().'.'.$request->picture->extension();
//                $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public');
//                $oProduct->img = $fileName ;
//                $oProduct->save();
//                return Result::make(Result::OK, $oProduct);
//            }
//        } catch (ModelNotFoundException|QueryException $e){
//            return Result::make(Result::ERROR, $e->getMessage());
//        }
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }



    /**
     * @return mixed
     */
    public function resource()
    {
        // TODO: Implement resource() method.
    }


    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        // TODO: Implement resource() method.
    }


    /**
     * @return mixed
     */
    public function parent_resource_detail($id)
    {
        return new ParentProductResource(
            Product::findOrFail($id)
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail_by_b2b($id)
    {

        return new CatalogResource(
            Product::where("b2b_id", $id)
                ->with([
                    "status",
                    "availability",
                    "type",
                    "features",
                    "galleries",
                    "price",
                    "specifications",
                    "links",
                    "parent",
                ])->get()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail_by_catalog($b2b, $id)
    {
        try {
            $oCatalog_sections = CatalogSection::where("catalog_id", $id)
                ->get()
                ->pluck("section_id")->toArray();


            $oProductsSections = SectionProduct::
            whereIn("section_id", $oCatalog_sections)
                ->where("catalog_id", $id)
                ->get()
                ->pluck("product_id")
                ->toArray();


            return new CatalogResource(
                Product::where("b2b_id", $b2b)
                    ->whereIn("id", $oProductsSections)
                    ->with([
                        "status",
                        "availability",
                        "type",
                        "features",
                        "galleries",
                        "price",
                        "specifications",
                        "links",
                        "parent",
                    ])->get()
            );
        } catch (ModelNotFoundException|QueryException|Exception|ResourceNotFoundException $e){
            return $e->getMessage();
        }
    }


    /**
     * @param Request $request
     * @param int $product
     * @return mixed
     */
    public function publish(Request $request, int $product)
    {
        $oCatalog= Product::where("id", $product)->first();
        $oCatalog->publish_toogle($request->get("published"));

        return $oCatalog->toArray();
    }
}
