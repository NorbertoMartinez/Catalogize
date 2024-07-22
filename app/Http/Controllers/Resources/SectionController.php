<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\Catalog;
use App\Models\Resources\CatalogSection;
use App\Models\Resources\Section;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use const Grpc\STATUS_OK;

class SectionController extends Controller implements ResourceInterface
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


    public function upload_background(Request $request, int $section){
        $oItem = Section::where("id", $section)->first();
        return $oItem->upload_background($request, "section");
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
            $oCatalog = Catalog::find($request->get("catalog")["id"]);

            $oSection = Section::create($request->get("section"));
            $oSection->gen_hash();
            $oSection->gen_qr();

            $oCatalogSection = new CatalogSection([
                "catalog_id" => $oCatalog->id,
                "section_id" => $oSection->id,
                "status_id" => Status::DEFAULT
            ]);

            $oCatalog->sections()->save($oCatalogSection);

            return Result::make(Result::OK, $oSection);

        } catch (QueryException $exception){
            return Result::make(Result::ERROR, $exception->getMessage());
        } catch (ModelNotFoundException $exception){
            return Result::make(Result::ERROR, $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return Inertia::render('Sections/Edit', [
            'item' => $section,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\Section  $section
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {

        try {

            $section->fill($request->get("section"))->save();

            return Result::make(Result::OK, $section);
        } catch (QueryException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        } catch (ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }

    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param int                      $section
     *
     * @return mixed
     */
    public function publish(Request $request, int $section)
    {
        try {
            $oSection= Section::where("id", $section)->first();
            $oSection->publish_toogle($request->get("published"));

            return Result::make(Result::OK, $oSection);
        } catch (QueryException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        } catch (ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\Section  $section
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            foreach ($section->products()->get() as $cProducts){
                $cProducts->delete();
            }
            $section->delete();

            return Result::make(Result::OK);
        } catch (QueryException $e){

            return Result::make(Result::ERROR, $e->getMessage());
        }
        catch (ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function resource()
    {
//        return new CatalogResource(
//            Section::where("id", ">", 1)
//                ->get()
//        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id=null)
    {
        return new CatalogResource(
          Section::where("id", $id)
            ->with([
                "products.product",
                "status",
                "catalog",
            ])
            ->get()
        );
    }
}
