<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Brochure;
use App\Models\Resources\BrochureSerieBrochure;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class BrochureSerieBrochureController extends Controller
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $brochureItem = Brochure::create($request->all());

            $brochureItem->upload_resource($request);
            $brochureItem->upload_pattern($request);

            $brochureItemBrochure = BrochureSerieBrochure::create([
                "brochure_id" => $request->get("serie_id"),
                "brochure_serie_id" => $brochureItem->id,
            ]);

            return Result::make(Result::OK, $brochureItem);
        }catch (ModelNotFoundException|QueryException|ValidationException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\BrochureSerieBrochure  $brochureSerieBrochure
     * @return \Illuminate\Http\Response
     */
    public function show(BrochureSerieBrochure $brochureSerieBrochure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\BrochureSerieBrochure  $brochureSerieBrochure
     * @return \Illuminate\Http\Response
     */
    public function edit(BrochureSerieBrochure $brochureSerieBrochure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\BrochureSerieBrochure  $brochureSerieBrochure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrochureSerieBrochure $brochureSerieBrochure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\BrochureSerieBrochure  $brochureSerieBrochure
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrochureSerieBrochure $brochureSerieBrochure)
    {
        //
    }
}
