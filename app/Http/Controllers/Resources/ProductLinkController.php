<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\ProductLink;
use App\Models\Result;
use Illuminate\Http\Request;

class ProductLinkController extends Controller implements ResourceInterface
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
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rFeature = $request->get("link");
        $rFeature["status_id"] = Status::DEFAULT;
        $request->merge(["link"=>$rFeature]);

        $oFeature = ProductLink::create($request->get("link"));

        return Result::make(Result::OK, $oFeature);    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\ProductLink  $productLink
     * @return \Illuminate\Http\Response
     */
    public function show(ProductLink $productLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\ProductLink  $productLink
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductLink $productLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\ProductLink  $productLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductLink $productLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\ProductLink  $productLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductLink $productLink)
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
            ProductLink::where("product_id", $id)
                ->with([
                    "status",
                    "type",
                ])
                ->get()
        );
    }
}
