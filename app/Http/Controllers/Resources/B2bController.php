<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\B2b;
use App\Models\Resources\B2bBussinessType;
use App\Models\Result;
use App\Models\User;
use App\Models\UserB2b;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class B2bController extends Controller implements ResourceInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('B2bs/Index', [
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
//        $fields = [
//            "b2b" => 'required',
//        ];
//
//        if(\Validator::make($request->all(), $fields)->fails()){
//            return Result::make(Result::ERROR,
//                \Validator::make($request->all(), $fields)->errors());
//        }

        try {


            $oB2b = B2b::create($request->get("b2b"));

            foreach ($request->get("bussiness_types") as $bussines_type){

                $oB2b->b2bBussinessTypes()->save(new B2bBussinessType([
                    "bussiness_type_id" => $bussines_type,
                    "status_id" => Status::DEFAULT
                ]));
            }

            $userB2b = UserB2b::create([
                "b2b_id"=>$oB2b->id,
                "user_id"=>auth()->user()->id,
            ]);

            return Result::make(Result::OK, $oB2b);



        } catch (QueryException|ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\B2b  $b2b
     * @return \Illuminate\Http\Response
     */
    public function show(B2b $b2b)
    {

        return Inertia::render('B2bs/Edit', [
            'item' => $b2b->get()->find($b2b),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\B2b  $b2b
     * @return \Illuminate\Http\Response
     */
    public function edit(B2b $b2b)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\B2b  $b2b
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, B2b $b2b)
    {
        //
    }


    public function store_picture(Request $request, int $b2b){
        $oB2b = B2b::where("id", $b2b)->first();
        return $oB2b->upload_image($request, "logo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\B2b  $b2b
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(B2b $b2b)
    {

        try {

            foreach($b2b->userB2b()->get() as $userB2b)
            {
                $userB2b->delete();
            }

            foreach ($b2b->catalogs()->get() as $catalog){
                foreach ($catalog->sections()->get() as $cSection){
                    foreach ($cSection->section()->products->get() as $cSection){


                        $cSection->section()->first()->delete();
                    }

                    $cSection->section->delete();
                }
                $catalog->delete();
            }

            foreach ($b2b->b2bBussinessTypes()->get() as $type){
                $type->delete();
            }


            $b2b->delete();

            return Result::make(Result::OK);
        } catch (QueryException|ModelNotFoundException $e){
            return Result::make(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new CatalogResource(
            B2b::whereIn("id", auth()->user()->userB2b()->pluck("b2b_id")->toArray())
            ->get()->toArray());
//        return new CatalogResource(
//            B2b::whereIn("", auth()->user()->userB2b()->pluck()->toArray())
//            ->with("b2b.b2bBussinessTypes.type")
//            ->get()->toArray());
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            B2b::where("id", $id)->with([
                "status",
                "responsable",
                "b2bBussinessTypes.type.catalogsTypes.catalog",
                "catalogs",
            ])->get()
        );
    }

    public function resource_user(){
        return new CatalogResource(
            UserB2b::where("b2b_id",
                auth()->user()->userB2b()->pluck("b2b_id")->toArray())
            ->get()
        );

    }


    /**
     * @param Request $request
     * @param int $product
     * @return mixed
     */
    public function publish(Request $request, int $b2b)
    {
        $oCatalog= B2b::where("id", $b2b)->first();
        $oCatalog->publish_toogle($request->get("published"));

        return $oCatalog->toArray();
    }
}
