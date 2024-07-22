<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\ARPattern;
use App\Models\Catalogs\Status;
use Illuminate\Http\Request;

class ARPatternController extends Controller implements ResourceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Models\Catalogs\ARPattern  $aRPattern
     * @return \Illuminate\Http\Response
     */
    public function show(ARPattern $aRPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\ARPattern  $aRPattern
     * @return \Illuminate\Http\Response
     */
    public function edit(ARPattern $aRPattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\ARPattern  $aRPattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ARPattern $aRPattern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\ARPattern  $aRPattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(ARPattern $aRPattern)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            ARPattern::where("status_id", Status::DEFAULT)->get()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            ARPattern::where("id", $id)->first()
        );
    }
}
