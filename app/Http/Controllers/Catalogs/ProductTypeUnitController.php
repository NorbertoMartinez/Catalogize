<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\ProductTypeUnit;
use Illuminate\Http\Request;

class ProductTypeUnitController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\ProductTypeUnit  $productTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTypeUnit $productTypeUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\ProductTypeUnit  $productTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTypeUnit $productTypeUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\ProductTypeUnit  $productTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTypeUnit $productTypeUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\ProductTypeUnit  $productTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTypeUnit $productTypeUnit)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            ProductTypeUnit::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($product_type_id)
    {
        return new CatalogResource(
            ProductTypeUnit::where("product_type_id", $product_type_id)->with([
                "status",
                "unit"
            ])->get()
        );
    }
}
