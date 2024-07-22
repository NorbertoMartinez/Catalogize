<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogType extends Model
{
    use HasFactory, HasGeneralStatus;





    public function products(){
        return $this->hasMany(CatalogTypeProductType::class,
            "catalog_type_id", "id");
    }
}
