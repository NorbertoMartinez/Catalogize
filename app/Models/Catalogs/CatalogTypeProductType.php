<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogTypeProductType extends Model
{
    use HasFactory, HasGeneralStatus;




    public function catalogType(){
        return $this->hasOne(CatalogType::class,
        "id", "catalog_type_id");
    }

    public function type(){
        return $this->hasOne(ProductType::class,
        "id", "product_type_id");
    }
}
