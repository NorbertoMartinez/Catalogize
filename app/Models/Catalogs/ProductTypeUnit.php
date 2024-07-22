<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeUnit extends Model
{
    use HasFactory, HasGeneralStatus;



    public function unit(){
        return $this->hasOne(Unit::class, "id","unit_id");
    }

    public function productType(){
        return $this->hasOne(ProductType::class, "id","product_type_id");
    }
}
