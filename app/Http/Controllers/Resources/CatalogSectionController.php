<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Resources\CatalogSection;
use Illuminate\Http\Request;

class CatalogSectionController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Resources\CatalogSection  $catalogSection
     * @return \Illuminate\Http\Response
     */
    public function show(CatalogSection $catalogSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\CatalogSection  $catalogSection
     * @return \Illuminate\Http\Response
     */
    public function edit(CatalogSection $catalogSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\CatalogSection  $catalogSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatalogSection $catalogSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\CatalogSection  $catalogSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatalogSection $catalogSection)
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
            CatalogSection::where("catalog_id", $id)
                ->with([
                    "section.products.product",
                    "section.status",
                    "status",
                    "catalog",
                ])
                ->get()
        );
    }
}
