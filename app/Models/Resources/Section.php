<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Publishable;
use App\Catalogize\Traits\Qreable;
use App\Catalogize\Traits\Backgroundeable;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Section extends Model
{
    use HasFactory,
        HasGeneralStatus,
        Publishable,
        Backgroundeable,
        Qreable;

    protected $fillable = [
        "background",
        "hash",
        "title",
        "subtitle",
        "description",
        "status_id",
    ];



    public function products(){
        return $this->hasMany(SectionProduct::class, "section_id", 'id');
    }

    public function catalog(){
        return $this->belongsTo(CatalogSection::class, "section_id", 'id');
    }



    /**
     * Generate a Hash Section with B2bHash Key
     *
     * @param $b2b_hash
     *
     * @return string
     */

    public static function hash($b2b_hash){
        return Hash::make("section/".time().$b2b_hash);
    }
}
