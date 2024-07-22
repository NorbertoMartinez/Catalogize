<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\HasProduct;
use App\Models\Catalogs\LinkType;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLink extends Model
{
    use HasFactory, HasGeneralStatus, HasProduct;


    protected $fillable = [
        "value",
        "product_id",
        "link_type_id",
        "status_id",
    ];


    public function type(){
        return $this->hasOne(LinkType::class, "id", 'link_type_id');
    }

}
