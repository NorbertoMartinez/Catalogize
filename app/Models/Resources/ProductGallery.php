<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\HasProduct;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory,
        HasProduct,
        HasGeneralStatus;


    protected $fillable = [
        "name",
        "description",
        "trigger",
        "product_id",
        "status_id",
    ];

    public function items(){
        return $this->hasMany(ProductGalleryItem::class,
            "product_gallery_id", 'id');
    }
}
