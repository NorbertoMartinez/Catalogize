<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemesType extends Model
{
    use HasFactory, HasGeneralStatus;

    protected $fillable = [
        "name",
        "status_id",
    ];


    public function theme(){
        return $this->belongsTo(Themes::class, "theme_type_id", "id");
    }

}
