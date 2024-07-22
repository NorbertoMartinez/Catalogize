<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\BussinessType;
use Illuminate\Http\Request;

class BussinessTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\BussinessType  $bussinessType
     * @return \Illuminate\Http\Response
     */
    public function show(BussinessType $bussinessType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\BussinessType  $bussinessType
     * @return \Illuminate\Http\Response
     */
    public function edit(BussinessType $bussinessType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\BussinessType  $bussinessType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BussinessType $bussinessType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\BussinessType  $bussinessType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BussinessType $bussinessType)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            BussinessType::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            BussinessType::where("id", $id)->with([
                "status",
                "catalogsTypes.catalog.productTypes.productType.status"
            ])->get()
        );
    }
}
