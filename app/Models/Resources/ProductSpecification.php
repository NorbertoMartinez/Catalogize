<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\HasProduct;
use App\Models\Catalogs\SpecificationType;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory, HasGeneralStatus, HasProduct;


    public function type(){
        return $this->hasOne(SpecificationType::class, "id", 'specification_type_id');
    }

    public function items(){
        return $this->hasMany(ProductSpecificationItem::class, "product_specification_id", 'id');
    }


}
