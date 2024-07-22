<?php

namespace App\Models\Catalogs;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeFeature extends Model
{
    use HasFactory, HasGeneralStatus;



    public function feature(){
        return $this->hasOne(feature::class, "id","feature_id");
    }


    public function productType(){
        return $this->belongsTo(ProductType::class, "id","product_type_id");
    }
}
