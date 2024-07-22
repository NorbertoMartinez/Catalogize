<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\ProductFeature;
use App\Models\Result;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller implements ResourceInterface
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


        $rFeature = $request->get("feature");
        $rFeature["status_id"] = Status::DEFAULT;
        $request->merge(["feature"=>$rFeature]);

        $oFeature = ProductFeature::create($request->get("feature"));

        return Result::make(Result::OK, $oFeature);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\ProductFeature  $productFeature
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFeature $productFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\ProductFeature  $productFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductFeature $productFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\ProductFeature  $productFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFeature $productFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\ProductFeature  $productFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductFeature $productFeature)
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
            ProductFeature::where("product_id", $id)
            ->with([
                "status",
                "feature",
            ])
            ->get()
        );
    }
}
