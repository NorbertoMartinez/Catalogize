<?php

namespace App\Http\Controllers\Operation;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Models\Catalogs\Status;
use App\Models\Operation\Visitor;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VisitorController extends Controller implements ResourceInterface
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
            $oVisitor = Visitor::create($request->get("visitor"));
            return Result::make(Result::OK, $oVisitor);
        } catch (ModelNotFoundException | QueryException $e){
            return Result::make(Result::ERROR, $e->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation\Visitor  $visitor
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        try{

//            $visitor->disable();

            return Result::make(Result::OK, $visitor);
        } catch (ModelNotFoundException | QueryException $e){
            return Result::make(Result::ERROR, $e->errors());
        }
    }

    /**
     * @return mixed
     */
    public function resource()
    {
        return new ResourceCollection(
            Visitor::where("status_id", Status::DEFAULT)
                ->orderBy("id", "desc")->get()
        );
    }

    /**
     * @return mixed
     */
    public function resource_detail($id)
    {
        // TODO: Implement resource_detail() method.
    }
}
