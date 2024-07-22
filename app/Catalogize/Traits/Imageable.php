<?php

namespace App\Catalogize\Traits;

use App\Models\Result;

trait Imageable
{



    public function upload_image($request, $type='default'){
        $request->validate([
            'image' => 'required|file|image|max:2048',
        ]);

        try {
            if($request->file("image")) {

                $fileName = $this->id."_".$type."_".time().'.'.$request->image->extension();

                $filePath = $request->file('image')->storeAs('images', $fileName, 'public');

                $this->img = env("APP_URL")."/op/images/".$fileName ; //todo: create route

                if($this->save()){
                    return Result::make(Result::OK, 1);
                } else {

                    return Result::make(Result::ERROR, 0);
                }
            }
        } catch (ModelNotFoundException|QueryException $e){
            return ["status"=>$e->getCode(), "msg"=>$e->getMessage()];
        }
    }

}
