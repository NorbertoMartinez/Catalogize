<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Models\Catalogs\BrochureType;
use App\Models\Catalogs\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BrochureTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\BrochureType  $brochureType
     * @return \Illuminate\Http\Response
     */
    public function show(BrochureType $brochureType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\BrochureType  $brochureType
     * @return \Illuminate\Http\Response
     */
    public function edit(BrochureType $brochureType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\BrochureType  $brochureType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrochureType $brochureType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\BrochureType  $brochureType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrochureType $brochureType)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new ResourceCollection(
          BrochureType::where("status_id", Status::DEFAULT)->get()
        );
        // TODO: Implement resource() method.
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        // TODO: Implement resource_detail() method.
    }
}
