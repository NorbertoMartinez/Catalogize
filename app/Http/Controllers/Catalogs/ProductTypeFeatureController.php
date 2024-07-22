<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Http\Resources\ProductFeatures;
use App\Http\Resources\ProductFeaturesCollection;
use App\Models\Catalogs\ProductTypeFeature;
use Illuminate\Http\Request;

class ProductTypeFeatureController extends Controller implements ResourceInterface
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalogs\ProductTypeFeature  $productTypeFeature
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTypeFeature $productTypeFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\ProductTypeFeature  $productTypeFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTypeFeature $productTypeFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\ProductTypeFeature  $productTypeFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTypeFeature $productTypeFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\ProductTypeFeature  $productTypeFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTypeFeature $productTypeFeature)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            ProductTypeFeature::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($product_type_id)
    {
//        dump(ProductTypeFeature::where("product_type_id", $product_type_id)->with([
//            "feature"
//        ])->get());
        return new ProductFeaturesCollection(
            ProductTypeFeature::where("product_type_id", $product_type_id)->with([
                "feature"
            ])->get()
        );
    }
}
