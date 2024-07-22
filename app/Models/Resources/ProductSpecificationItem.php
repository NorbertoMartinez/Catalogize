<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecificationItem extends Model
{
    use HasFactory, HasGeneralStatus;


    public function specification(){
        return $this->belongsTo(ProductSpecification::class, "id", 'product_specification_id');
    }
}
