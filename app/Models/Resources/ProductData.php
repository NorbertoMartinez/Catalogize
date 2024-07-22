<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasAvailability;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Publishable;
use App\Models\Catalogs\Availability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    use HasFactory, HasGeneralStatus, Publishable, HasAvailability;

    protected $fillable = [
        "variable",
        "name",
        "description",
        "sku",
        "isStockeable",
        "stock",
        "isGlobalPrice",
        "price",
        "availability_id",
        "status_id",
        "product_id",
    ];



    public function _price()
    {
        return $this->hasOne(ProductPrice::class, "product_id", 'id');
    }

    public function parent()
    {
        return $this->hasOne(Product::class, "id", 'product_id');
    }
}
