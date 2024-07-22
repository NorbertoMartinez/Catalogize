<?php

namespace App\Http\Controllers\Catalogs;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Models\Catalogs\Themes;
use Illuminate\Http\Request;

class ThemesController extends Controller implements ResourceInterface
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
     * @param  \App\Models\Catalogs\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function show(Themes $themes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogs\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function edit(Themes $themes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogs\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Themes $themes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogs\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Themes $themes)
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
