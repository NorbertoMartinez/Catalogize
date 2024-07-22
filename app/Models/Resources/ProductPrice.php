<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\HasProduct;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory, HasGeneralStatus, HasProduct;


    public function taxes(){
        return $this->hasMany(ProductPriceTax::class, "product_price_id", 'id');
    }

}
