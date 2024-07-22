<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeBussiness extends Model
{
    use HasFactory;

    protected $fillable = [
        "bussiness_type_id",
        "theme_id",
    ];


    public function bussinessType(){
        return $this->hasOne(BussinessType::class, "id", "bussiness_type_id");
    }

    public function theme(){
        return $this->hasOne(Themes::class, "id", "theme_id");
    }
}
