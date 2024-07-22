<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureSerieBrochure extends Model
{
    use HasFactory;

    protected $fillable = [
        "brochure_id",
        "brochure_serie_id",
    ];


    public function serie(){
        return $this->hasOne(BrochureSerie::class, "id", "brochure_serie_id");
    }

    public function brochure(){
        return $this->hasOne(Brochure::class, "id", "brochure_id");
    }
}
