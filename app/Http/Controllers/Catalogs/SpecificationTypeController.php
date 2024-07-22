<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\SpecificationType;
use Illuminate\Http\Request;

class SpecificationTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\SpecificationType  $specificationType
     * @return \Illuminate\Http\Response
     */
    public function show(SpecificationType $specificationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\SpecificationType  $specificationType
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecificationType $specificationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\SpecificationType  $specificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecificationType $specificationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\SpecificationType  $specificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecificationType $specificationType)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            SpecificationType::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            SpecificationType::where("id", $id)->with([
                "status",
            ])->get()
        );
    }
}
