<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasAvailability;
use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Imageable;
use App\Catalogize\Traits\Publishable;
use App\Models\Catalogs\Availability;
use App\Models\Catalogs\ProductType;
use App\Models\Catalogs\Status;
use App\Models\Catalogs\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static firstOrCreate($rProduct)
 */
class Product extends Model
{
    use HasFactory,
        Imageable,
        Publishable,
        HasB2b,
        HasAvailability,
        HasGeneralStatus;

    protected $fillable = [
        "hash",
        "qr_code",
        "name",
        "description",
        "img",
        "b2b_id", //?
        "availability_id",
        "product_type_id",
        "status_id",
    ];


    public function variables(){
        return $this->hasMany(ProductData::class, "product_id", 'id');
    }


    public function type(){
        return $this->hasOne(ProductType::class, "id", 'product_type_id');
    }

    public function features(){
        return $this->hasMany(ProductFeature::class, "product_id", 'id');
    }

    public function galleries(){
        return $this->hasMany(ProductGallery::class, "product_id", 'id');
    }

    public function links(){
        return $this->hasMany(ProductLink::class, "product_id", 'id');

    }
}
