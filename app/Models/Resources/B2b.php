<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasGeneralStatus;
use App\Catalogize\Traits\Imageable;
use App\Catalogize\Traits\Publishable;
use App\Models\Catalogs\BussinessType;
use App\Models\Catalogs\Status;
use App\Models\User;
use App\Models\UserB2b;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class B2b extends Model
{
    use HasFactory, Publishable, HasGeneralStatus, Imageable;

    protected $fillable = [
        "name",
        "fiscal_code",
        "social_reason",
        "slogan",
        "img",
        "telecom",
        "address",

        "status_id",
    ];

    protected $appends = ["hash"];

    public function responsable(){
        return $this->hasOne(User::class, "id", 'user_id');
    }


    public function userB2b(){
        return $this->hasMany(UserB2b::class, "b2b_id", "id");
    }

    public function b2bBussinessTypes(){
        return $this->hasMany(B2bBussinessType::class, "b2b_id", "id");
    }

    public function clients(){
        return $this->hasMany(B2bClient::class, "b2b_id", "id");
    }

    public function catalogs(){
        return $this->hasMany(B2bClient::class, "b2b_id", "id");
    }



//    protected static function boot()
//    {
//        parent::boot();
//
//
//        B2b::creating(function($model) {
//
//            if( $model->user_id == null){
//                $model->user_id = auth()->user()->id;
//            }
//        });
//    }

    public function getHashAttribute(){
        return $this->hash = Crypt::encryptString($this->id.$this->name);
    }
}
