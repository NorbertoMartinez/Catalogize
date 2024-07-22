<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class CatalogSection extends Model
{
    use HasFactory, HasGeneralStatus;

    protected $fillable = [
        "catalog_id",
        "section_id",
        "status_id",
    ];



    public function catalog(){
        return $this->hasOne(Catalog::class, "id", 'catalog_id');
    }

    public function section(){
        return $this->hasOne(Section::class, "id", 'section_id');
    }

}
