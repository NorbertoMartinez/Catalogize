<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Publishable;
use App\Catalogize\Traits\Qreable;
use App\Models\Catalogs\ARPattern;
use App\Models\Catalogs\BrochureType;
use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class Brochure extends Model
{
    use HasFactory, HasGeneralStatus, Publishable, HasB2b, Qreable;

    protected $fillable = [
        "title",
        "subtitle",
        "description",
        "resource",
        "pattern",
        "pattern_img",
        "scale",
        "radials",
        "isExternalPattern",
        "isLink",
        "link",
        "isPlayable",
        "isSoundable",
        "status_id",
        "b2b_id",
        "brochure_serie_id",
        "hash",
        "qr_code",
        "brochure_type_id",
    ];


    /**
     * Appends
     * @var string[]
     */
    protected $appends = [
        "url",
    ];

    public function brochure_type_id(){
        return $this->hasOne(BrochureType::class, "id","brochure_type_id");
    }


//    public function pattern(){
//        return $this->hasOne(ARPattern::class, "id","pattern_id");
//    }

    /**
     * Attribute URL generator
     * @return string
     */
    public function getUrlAttribute(){
        return \Request::root()."/viewer/scene/?d=".base64_encode($this->hash);
    }



    public function upload_resource($request, $type='default'){
        $request->validate([
            'attached' => 'required|file|max:5048',
        ]);

        try {
            if($request->file("attached")) {

                $fileName = $this->id."_".$type."_".time().'.'.$request->attached->extension();

                $filePath = $request->file('attached')->storeAs('images', $fileName, 'public');

                $this->resource = env("APP_URL")."/op/serie/".$fileName ; //todo: create route

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

    public function upload_pattern($request, $type='default'){
        $request->validate([
            'patt_file' => 'required|file|max:5048',
        ]);

        try {
            if($request->file("patt_file")) {

                $fileName = $this->id."_".$type."_".time().'.patt';

                $filePath = $request->file('patt_file')->storeAs('images', $fileName, 'public');

                $this->pattern = env("APP_URL")."/op/pattern/".$fileName ; //todo: create route

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
