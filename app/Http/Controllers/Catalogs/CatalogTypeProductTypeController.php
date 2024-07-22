<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\CatalogTypeProductType;
use Illuminate\Http\Request;

class CatalogTypeProductTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\CatalogTypeProductType  $catalogTypeProductType
     * @return \Illuminate\Http\Response
     */
    public function show(CatalogTypeProductType $catalogTypeProductType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\CatalogTypeProductType  $catalogTypeProductType
     * @return \Illuminate\Http\Response
     */
    public function edit(CatalogTypeProductType $catalogTypeProductType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\CatalogTypeProductType  $catalogTypeProductType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatalogTypeProductType $catalogTypeProductType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\CatalogTypeProductType  $catalogTypeProductType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatalogTypeProductType $catalogTypeProductType)
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
            CatalogTypeProductType::where("catalog_type_id", $id)
            ->with([
                "type"
            ])->get()
        );

    }
}
