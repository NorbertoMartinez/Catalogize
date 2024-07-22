<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\HasProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereIn(string $string, $oCatalog_sections)
 * @method static firstOrCreate(array $array)
 */
class SectionProduct extends Model
{
    use HasFactory, HasGeneralStatus, HasProduct;

    protected $fillable = [
        "status_id",
        "product_id",
        "catalog_id",
        "section_id",
    ];


    public function section(){
        return $this->hasOne(Section::class, "id", 'section_id');
    }

    public function catalog(){
        return $this->hasOne(Catalog::class, "id", 'catalog_id');
    }

}
