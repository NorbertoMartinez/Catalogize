<?php

namespace App\Catalogize\Traits;

use App\Models\Resources\Product;

trait HasProduct
{

    public function product(){
        return $this->hasOne(Product::class, "id", 'product_id');
    }

}
