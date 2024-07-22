<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Resources\Brochure;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class BrochureController extends Controller implements ResourceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {

        return Inertia::render('Brochures/Index', [
            'b2bs' => auth()->user()->userB2b()
                ->with("b2b.b2bBussinessTypes.type")
                ->get()->toArray(),
        ]);
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

            $request->validate([
                'brochure.b2b_id' => 'required',
                'brochure.name' => 'required',
                'brochure.pattern_id' => 'required',
                'brochure.brochure_type_id' => 'required',
                'brochure.status_id' => 'required',
            ]);

            $oBrochure = Brochure::create($request->get("brochure"));

            /* Generate Hash */
            $oBrochure->gen_hash();

            /* Generate QR Code */
            $oBrochure->gen_qr();

            return Result::make(Result::OK, $oBrochure);

        } catch(ModelNotFoundException | QueryException | ValidationException $e) {

            return Result::make(Result::ERROR, $e->errors());

        }
    }

//    public function upload_pattern(Request $request, $brochure){
//
//
//        try {
//            //tODO:  Patt mimes type application/octet-stream
//            $request->validate([
//                'pattern' => 'required|file|image|max:2048',
//            ]);
//
//            if($request->file("pattern")) {
//                $oBrochure = Brochure::where("id", $brochure)->first();
//                $fileName = $oBrochure->id."_pattern_".time().'.'.$request->pattern->extension();
//                $filePath = $request->file('pattern')->storeAs('patterns', $fileName, 'public');
//                $oBrochure->pattern = env("APP_URL")."/op/patterns/".$fileName ;
//                $oBrochure->save();
//                return Result::make(Result::OK, $this);
//            }
//        } catch (ModelNotFoundException|ValidationException $e){
//            return Result::make(Result::ERROR, $e->errors());
//        }
//
//    }

    public function upload_resource(Request $request, $brochure){


        try {
            //tODO:  Patt mimes type application/octet-stream
            $request->validate([
                'resource' => 'required|file|max:5048',
            ]);

            if($request->file("resource")) {
                $oBrochure = Brochure::where("id", $brochure)->first();
                $fileName = $oBrochure->id."_resource_".time().'.'.$request->resource->extension();
                $filePath = $request->file('resource')->storeAs('ar_resources', $fileName, 'public');
                $oBrochure->resource = env("APP_URL")."/op/ar_resources/".$fileName ;

                if($request->get("brochure_type_id")){
                    $oBrochure->brochure_type_id = $request->get("brochure_type_id") ;
                }
                $oBrochure->save();
                return Result::make(Result::OK, $this);
            }
        } catch (ModelNotFoundException| QueryException | ValidationException $e){
            return Result::make(Result::ERROR, $e->errors());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function show(Brochure $brochure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function edit(Brochure $brochure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\Brochure  $brochure
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Brochure $brochure)
    {
        try{

            $oBrochure = $brochure->update($request->get("brochure"));

            return Result::make(Result::OK, $oBrochure);

        } catch(ModelNotFoundException | ValidationException $e) {

            return Result::make(Result::ERROR, $e->errors());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\Brochure  $brochure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brochure $brochure)
    {
        try {

            $brochure->delete();

            return Result::make(Result::OK);

        } catch (QueryException | ModelNotFoundException $e){

            return Result::make(Result::ERROR, $e->getMessage());
        }

    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new ResourceCollection(
            Brochure::ByB2b()->with([
                "pattern"
            ])->get()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            Brochure::ByB2b()->where("id", $id)->with([
                "pattern",
                "b2b",
                "status",
            ])->first()
        );
    }


    /**
     * @param Request $request
     * @param int $product
     * @return mixed
     */
    public function publish(Request $request, int $brochure)
    {
        $oCatalog= Brochure::where("id", $brochure)->first();
        $oCatalog->publish_toogle($request->get("published"));

        return $oCatalog->toArray();
    }
}
