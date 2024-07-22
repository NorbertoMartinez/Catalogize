<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Publishable;
use App\Catalogize\Traits\Qreable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureSerie extends Model
{
    use HasFactory, HasGeneralStatus, Publishable, HasB2b, Qreable;

    protected $fillable = [
        "name",
        "description",
        "b2b_id",
        "status_id",
    ];



    /**
     * Appends
     * @var string[]
     */
    protected $appends = [
        "url",
    ];


    /**
     * Attribute URL generator
     * @return string
     */
    public function getUrlAttribute(){
        return \Request::root()."/viewer/scene/?d=".base64_encode($this->hash);
    }

    public function items(){
        return $this->hasMany(BrochureSerieBrochure::class, "brochure_serie_id", "id");
    }
}
