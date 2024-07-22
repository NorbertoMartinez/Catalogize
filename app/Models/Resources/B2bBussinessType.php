<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\HasGeneralStatus;
use App\Models\Catalogs\BussinessType;
use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2bBussinessType extends Model
{
    use HasFactory,
        HasGeneralStatus,
        HasB2b;

    protected $fillable = [
        "b2b_id",
        "bussiness_type_id",
        "status_id"
    ];



    public function type(){
        return $this->hasOne(BussinessType::class, "id","bussiness_type_id");
    }

}
