<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Events\CatalogCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\B2b;
use App\Models\Resources\Catalog;
use App\Models\Resources\CatalogSection;
use App\Models\Resources\Product;
use App\Models\Resources\Section;
use App\Models\Resources\SectionProduct;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Inertia\Inertia;

class CatalogController extends Controller implements ResourceInterface
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        $oCatalogs = Catalog::ByB2b()
            ->with([
                "type",
                "b2b",
                "sections.section"
            ])
            ->get();

        return Inertia::render('Catalogs/Index', [
            'catalogs' => $oCatalogs,
            'b2bs' => auth()->user()->userB2b()
                ->with("b2b.b2bBussinessTypes.type.catalogsTypes.catalog")
                ->get()->toArray(),
        ]);
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


    public function clone(Request $request, int $catalog){

        try {
            $oCatalog = Catalog::with([
                "type.products.type",
                "b2b",
                "status",
                "sections.section.products.product"
            ])->get()->find($catalog);

            $nCatalog = Catalog::create($oCatalog->attributesToArray());

            foreach($oCatalog->sections()->get() as $section)
            {
                $nSection = Section::create($section->section->attributesToArray());

                $catalogSection = new CatalogSection([
                    "status_id" => Status::DEFAULT,
                    "catalog_id" => $nCatalog->id,
                    "section_id" => $nSection->id,
                ]);

                $nCatalog->sections()->save($catalogSection);
            }

            /* Generate Hash */
            $nCatalog->gen_hash();

            /* Generate QR Code */
            $nCatalog->gen_qr();

            return Result::make(Result::OK, $nCatalog);

        } catch (QueryException $e){
            return Result::make(Result::ERROR, $e->getMessage());

        } catch (ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());

        }

    }

    public function upload_background(Request $request, int $catalog){
        $oProduct = Catalog::where("id", $catalog)->first();
        return $oProduct->upload_background($request, "catalog");
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $fields = [
            "catalog.name" => 'required',
        ];

        if(\Validator::make($request->all(), $fields)->fails()){
            return Result::make(Result::ERROR,
                \Validator::make($request->all(), $fields)->errors());
        }

        try {

            $b2b = B2b::findOrFail($request->get("b2b_id"));

            $oCatalog = new Catalog($request->get("catalog"));

            $b2b->catalogs()->save($oCatalog);

            /* Generate Hash */
            $oCatalog->gen_hash();

            /* Generate QR Code */
            $oCatalog->gen_qr();

            return Result::make(Result::OK, $oCatalog);

        } catch (QueryException|ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\Catalog  $catalog
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function show(Catalog $catalog)
    {

        $oCatalog = Catalog::
            with([
                "type.products.type",
                "b2b",
                "status",
                "sections.section.products.product"
            ])->get()->find($catalog);


        $oProducts = Product::where("b2b_id", $oCatalog->b2b->id)->get();

        return Inertia::render('Catalogs/Edit', [
            'catalog' => $oCatalog,
            'products' => $oProducts,
            'b2bs' => auth()->user()->userB2b()
                ->with("b2b.b2bBussinessTypes.type.catalogsTypes.catalog")
                ->get()->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\Catalog  $catalog
     *
     * @return \App\Models\Resources\Catalog|\Illuminate\Http\Response
     */
    public function update(Request $request, Int $catalog)
    {



        $oCatalog= Catalog::where("id", $catalog)->first();

        $oCatalog->fill($request->all());

        $oCatalog->save();

        CatalogCreated::dispatch($oCatalog);

    }

    public function publish(Request $request, int $catalog)
    {


        $oCatalog= Catalog::where("id", $catalog)->first();
        $oCatalog->publish_toogle($request->get("published"));

        return $oCatalog->toArray();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\Catalog  $catalog
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        try {
            foreach ($catalog->sections()->get() as $cSection){
                $sectionProducts = $cSection->section()->with([
                    "products.product.features",
                    "products.product.galleries.items",
                    "products.product.links"
                ])->first();

                foreach($sectionProducts->products as $sectionProduct){
//                    dump($sectionProduct->product);


                    foreach ($sectionProduct->product->features as $feature){
                        $feature->delete();
                    }
                    foreach ($sectionProduct->product->links as $link){
                        $link->delete();

                    }
                    foreach ($sectionProduct->product->galleries as $gallery){
                        foreach($gallery->items as $item){
                            $item->delete();
                        }
                        $gallery->delete();
                    }

                    $sectionProduct->delete();
                    $sectionProduct->product->delete();

                }
//                dd($sectionProducts);
                $cSection->section()->first()->delete();
            }
            $catalog->delete();

            return Result::make(Result::OK);
        } catch (QueryException $e){

            return Result::make(Result::ERROR, $e->getMessage());
        }
        catch (ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }

    }

    /**
     * @return mixed
     */
    public function resource()
    {
//        dd(auth()->user()->userB2b()->get());

//        dd(Catalog::ByB2b()->get());
        return new CatalogResource(
            Catalog::ByB2b()->Relations()->get()
        );

    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        // TODO: Implement resource_detail() method.
    }
}
