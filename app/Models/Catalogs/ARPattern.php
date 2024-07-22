<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ARPattern extends Model
{
    use HasFactory, HasGeneralStatus;

    protected $fillable = [
        "name",
        "img",
        "patt",
        "status_id",
    ];


}
