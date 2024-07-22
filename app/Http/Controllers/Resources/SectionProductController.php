<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Models\Catalogs\Status;
use App\Models\Resources\Section;
use App\Models\Resources\SectionProduct;
use App\Models\Result;
use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SectionProductController extends Controller implements ResourceInterface
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
        try {
            $assigned = [];

            SectionProduct::where("product_id", $request->get("product")["id"])->delete();

            foreach($request->get("sections")  as $sections){

                SectionProduct::firstOrCreate([
                    "product_id" => $request->get("product")["id"],
                    "section_id" => $sections["section"]["id"],
                    "catalog_id" => $request->get("catalog_id"),
                    "status_id" => Status::DEFAULT,
                ]);
            }

            return Result::make(Result::OK, SectionProduct::where("product_id", $request->get("product")["id"])->get()  );

        } catch (QueryException|ModelNotFoundException|ErrorException|Exception $e){
            return Result::make(Result::ERROR, $e->errors());
        }

    }

    public function mass_store(Request $request, Section $section){
        try {

//            dump($section->title);
//            dump(Section::find($section));
//            dd($request->get("products"));

            $sectionProducts = [];
            foreach($request->get("products") as $product)
            {

                $sectionProducts[] = SectionProduct::firstOrCreate([
                    "product_id" => $product,
                    "section_id" => $request->get("section"),
                    "catalog_id" => $request->get("catalog_id"),
                    "status_id" => 1,
                ]);
            }

            return Result::make(Result::OK, $sectionProducts);

        } catch (QueryException|ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionProduct  $sectionProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SectionProduct $sectionProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectionProduct  $sectionProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SectionProduct $sectionProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionProduct  $sectionProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SectionProduct $sectionProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionProduct  $sectionProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionProduct $sectionProduct)
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
        // TODO: Implement resource_detail() method.
    }

}
