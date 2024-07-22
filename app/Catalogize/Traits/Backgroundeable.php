<?php

namespace App\Catalogize\Traits;

use App\Models\Result;
use Illuminate\Validation\ValidationException;

trait Backgroundeable
{

    public function upload_background($request, $type='custom'){


        try {
            $request->validate([
            'background' => 'required|file|image|max:2048',
            ]);

            if($request->file("background")) {
                $fileName = $this->id."_".$type."_".time().'.'.$request->background->extension();
                $filePath = $request->file('background')->storeAs('backgrounds', $fileName, 'public');
                $this->background = env("APP_URL")."/op/background/".$fileName ;
                $this->save();
                return Result::make(Result::OK, $this);
            }
        } catch (ModelNotFoundException|QueryException|ValidationException $e){
            return Result::make(Result::ERROR, $e->errors());
        }
    }

}
