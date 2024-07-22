<?php

namespace App\Models\Resources;

use App\Catalogize\Traits\HasB2b;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2bClient extends Model
{
    use HasFactory, HasB2b;

    public function client(){
        return $this->hasOne(User::class, "id","user_id");
    }
}
