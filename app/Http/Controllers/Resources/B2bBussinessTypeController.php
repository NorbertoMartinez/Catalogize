<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Resources\B2bBussinessType;
use Illuminate\Http\Request;

class B2bBussinessTypeController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Resources\B2bBussinessType  $b2bBussinessType
     * @return \Illuminate\Http\Response
     */
    public function show(B2bBussinessType $b2bBussinessType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\B2bBussinessType  $b2bBussinessType
     * @return \Illuminate\Http\Response
     */
    public function edit(B2bBussinessType $b2bBussinessType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\B2bBussinessType  $b2bBussinessType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, B2bBussinessType $b2bBussinessType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\B2bBussinessType  $b2bBussinessType
     * @return \Illuminate\Http\Response
     */
    public function destroy(B2bBussinessType $b2bBussinessType)
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
    public function resource_detail($id = null)
    {
        if($id!=null){
            return new CatalogResource(
                B2bBussinessType::where("b2b_id", $id)
                    ->with([
                        "type"
                    ])
                    ->get()
            );
        }

    }
}
