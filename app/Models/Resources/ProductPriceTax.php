<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceTax extends Model
{
    use HasFactory, HasGeneralStatus;


    public function price(){
        return $this->belongsTo(ProductPrice::class, "id", 'product_price_id');
    }
}
