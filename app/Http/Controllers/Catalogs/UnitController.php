<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            Unit::all()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            Unit::where("id", $id)->with([
                "status",
            ])->get()
        );
    }
}
