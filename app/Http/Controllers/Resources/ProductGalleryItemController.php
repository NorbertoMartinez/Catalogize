<?php

namespace App\Http\Controllers\Resources;

use App\Catalogize\Interfaces\ResourceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResource;
use App\Models\Catalogs\Status;
use App\Models\Resources\ProductGalleryItem;
use App\Models\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductGalleryItemController extends Controller implements ResourceInterface
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
//        dd($request->input("record"));

        $request->validate([
            'image' => 'required|file|image|max:2048',
        ]);

        $fileModel = new ProductGalleryItem;
        if($request->file()) {

            $fileName = $request->gallery."_gallery_".time().'.'.$request->image->extension();
            $filePath = $request->file('image')->storeAs('gallery', $fileName, 'public');


            $fileModel->resource = env("APP_URL")."/op/gallery/".$fileName;
            $fileModel->name = $fileName;
            $fileModel->description = "...";
            $fileModel->product_gallery_id = $request->get('gallery');
            $fileModel->status_id = Status::DEFAULT;

            $fileModel->save();
            return Result::make(Result::OK, $fileModel);
        }






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources\ProductGalleryItem  $productGalleryItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGalleryItem $productGalleryItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources\ProductGalleryItem  $productGalleryItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGalleryItem $productGalleryItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources\ProductGalleryItem  $productGalleryItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGalleryItem $productGalleryItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources\ProductGalleryItem  $productGalleryItem
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(ProductGalleryItem $productGalleryItem)
    {
        try{

            $productGalleryItem->delete();

            return Result::make(Result::OK, 1);
        } catch (ModelNotFoundException|QueryException $exception){
            return Result::make(Result::ERROR, $exception->getMessage());
        }
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
            ProductGalleryItem::where("product_gallery_id", $id)
            ->get()
        );
    }
}
