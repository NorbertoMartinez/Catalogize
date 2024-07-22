<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Models\Catalogs\feature;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory, HasGeneralStatus;

    protected $fillable = [
        "value",
        "product_id",
        "feature_id",
        "status_id",
    ];



    public function feature(){
        return $this->hasOne(feature::class, "id", 'feature_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, "id", 'product_id');
    }

}
