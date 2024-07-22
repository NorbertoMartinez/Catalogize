<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Publishable;
use App\Catalogize\Traits\Qreable;
use App\Catalogize\Traits\Backgroundeable;
use App\Models\Catalogs\CatalogType;
use App\Models\Catalogs\Status;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Catalog extends Model
{
    use HasFactory,
        Publishable,
        HasB2b,
        Backgroundeable,
        HasGeneralStatus,
        Qreable;

    protected $fillable = [
      "hash",
      "background",
      "description",
      "name",
      "subtitle",
      "b2b_id",
      "catalog_type_id",
      "status_id",
      "qr_code",
    ];


    /**
     * Appends
     * @var string[]
     */
    protected $appends = [
        "url",
    ];



    public function type(){
        return $this->hasOne(CatalogType::class, "id", 'catalog_type_id');
    }

    public function sections(){
        return $this->hasMany(CatalogSection::class, "catalog_id", 'id');
    }




    /**
     * @param $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeByB2b($query): Builder
    {
        return $query->whereIn("b2b_id",
            auth()->user()->userB2b()->pluck("b2b_id")->toArray());
    }

    /**
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRelations($query): Builder
    {
        return $query->with([
            "type.products.type",
            "b2b",
            "status",
            "sections.section.products.product"
        ]);
    }

    /**
     * Attribute URL generator
     * @return string
     */
    public function getUrlAttribute(){
        return \Request::root()."/viewer/preview/?d=".base64_encode($this->hash);
    }





}
