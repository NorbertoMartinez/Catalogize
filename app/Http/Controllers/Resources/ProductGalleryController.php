<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\ProductGallery;
use App\Models\Result;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller implements ResourceInterface
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

//        name
//description
//trigger
//product_id
//status_id

        $rGallery = $request->get("gallery");
        $rGallery["status_id"] = Status::DEFAULT;
        $request->merge(["gallery"=>$rGallery]);

        $oGallery = ProductGallery::create($request->get("gallery"));

        return Result::make(Result::OK, $oGallery);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGallery $productGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $productGallery)
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
        return new CatalogResource(
            ProductGallery::where("product_id", $id)
            ->with([
                "items"
            ])
            ->get()
        );
    }
}
