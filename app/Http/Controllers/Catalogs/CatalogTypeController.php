<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\CatalogType;
use Illuminate\Http\Request;

class CatalogTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\CatalogType  $catalogType
     * @return \Illuminate\Http\Response
     */
    public function show(CatalogType $catalogType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\CatalogType  $catalogType
     * @return \Illuminate\Http\Response
     */
    public function edit(CatalogType $catalogType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\CatalogType  $catalogType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatalogType $catalogType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\CatalogType  $catalogType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatalogType $catalogType)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(CatalogType::all());
    }

    /**
     * @return mixed
     */
    public function resource_detail($id=0)
    {
        return new CatalogResource(
            CatalogType::where("id", $id)->with([
                "status",
                "products.type.status",
                "products.type.units.unit",
                "products.type.features.feature"
            ])->get()
        );

    }
}
