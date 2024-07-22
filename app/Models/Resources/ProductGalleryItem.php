<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalleryItem extends Model
{
    use HasFactory, HasGeneralStatus;


    protected $fillable = [
        "resource",
        "name",
        "description",
        "trigger",
        "product_gallery_id",
        "status_id"
    ];


    public function gallery(){
        return $this->belongsTo(ProductGallery::class, "id", 'product_gallery_id');
    }
}
