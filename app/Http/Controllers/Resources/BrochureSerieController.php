<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Resources\BrochureSerie;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BrochureSerieController extends Controller implements ResourceInterface
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
    { try{

        $request->validate([
            'b2b_id' => 'required',
            'name' => 'required',
            'status_id' => 'required',
        ]);

        $oBrochure = BrochureSerie::create($request->all());

        /* Generate Hash */
        $oBrochure->gen_hash();

        /* Generate QR Code */
        $oBrochure->gen_qr();

        return Result::make(Result::OK, $oBrochure);

    } catch(ModelNotFoundException | QueryException | ValidationException $e) {

        return Result::make(Result::ERROR, $e->errors());

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\BrochureSerie  $brochureSerie
     * @return \Illuminate\Http\Response
     */
    public function show(BrochureSerie $brochureSerie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\BrochureSerie  $brochureSerie
     * @return \Illuminate\Http\Response
     */
    public function edit(BrochureSerie $brochureSerie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\BrochureSerie  $brochureSerie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrochureSerie $brochureSerie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\BrochureSerie  $brochureSerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrochureSerie $brochureSerie)
    {
        //
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        // TODO: Implement resource() method.

        return new CatalogResource(
            BrochureSerie::byB2b()
                ->with("items.brochure")
                ->get()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        return new CatalogResource(
            BrochureSerie::byB2b()
                ->with("items.brochure")
                ->where("id",$id)->get()
        );
    }


    /**
     * @param Request $request
     * @param int $product
     * @return mixed
     */
    public function publish(Request $request, int $brochure)
    {
        $oCatalog= BrochureSerie::byB2b()->where("id", $brochure)->first();
        $oCatalog->publish_toogle($request->get("published"));

        return $oCatalog->toArray();
    }
}
