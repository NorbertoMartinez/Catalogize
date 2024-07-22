<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Status;
use App\Models\Operation\ViewBuilder;
use App\Models\Resources\Catalog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewBuilderController extends Controller
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
     * @param  \App\Models\Operation\ViewBuilder  $viewBuilder
     * @return \Illuminate\Http\Response
     */
    public function show(ViewBuilder $viewBuilder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation\ViewBuilder  $viewBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit(ViewBuilder $viewBuilder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation\ViewBuilder  $viewBuilder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViewBuilder $viewBuilder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation\ViewBuilder  $viewBuilder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViewBuilder $viewBuilder)
    {
        //
    }

    public function sceneBuilder(Request $request, $hash=null)
    {



        // TODO build data to AR
        return Inertia::render('Viewer/AR', [
            "builder" => []
        ]);
    }
    public function preview(Request $request, $hash=null)
    {

        $hash = base64_decode($request->input("d"));

        $oCatalog= Catalog::where("hash", $hash)
            ->where("status_id", Status::DEFAULT)
            ->with([
                "status",
                "type",
                "sections.section.status",
                "sections.section.products.product.b2b",
                "sections.section.products.product.status",
                "sections.section.products.product.availability",
                "sections.section.products.product.unit",
                "sections.section.products.product.type",
                "sections.section.products.product.features.feature",
                "sections.section.products.product.galleries.items",
                "sections.section.products.product.links.type",
                "sections.section.products.product.parent",
                "b2b",
            ])
            ->first();

        Inertia::setRootView('viewer');

        return Inertia::render('Viewer/Preview', [
            "catalog" => $oCatalog ? $oCatalog : ""
        ]);
    }
}
