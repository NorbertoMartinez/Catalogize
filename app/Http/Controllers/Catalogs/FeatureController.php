<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\feature;
use Illuminate\Http\Request;

class FeatureController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feature $feature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(feature $feature)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            feature::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            feature::where("id", $id)->with([
                "status",
            ])->get()
        );
    }
}
