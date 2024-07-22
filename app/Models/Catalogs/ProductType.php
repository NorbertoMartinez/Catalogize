<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory, HasGeneralStatus;



    public function features(){
        return $this->hasMany(ProductTypeFeature::class,
        "product_type_id", "id");
    }

    public function units(){
        return $this->hasMany(ProductTypeUnit::class,
        "product_type_id", "id");
    }
}
