<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory, HasGeneralStatus;

    protected $fillable = [
        "name",
        "path",
        "status_id",
        "theme_type_id",
    ];

    function type()
    {
        return $this->hasOne(ThemesType::class, "id", "theme_type_id");
    }

    function themeBussiness()
    {
        return $this->hasMany(ThemeBussiness::class, "theme_id", "id");
    }
}
