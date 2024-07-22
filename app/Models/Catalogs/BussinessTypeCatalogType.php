<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinessTypeCatalogType extends Model
{
    use HasFactory, HasGeneralStatus;


    public function bussiness(){
        return $this->belongsTo(BussinessType::class, "id", 'bussiness_type_id');
    }

    public function catalog(){
        return $this->hasOne(CatalogType::class,
            "id",'catalog_type_id');
    }
}
