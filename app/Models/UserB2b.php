<?php

namespace App\Models;

use App\Catalogize\Traits\HasB2b;
use App\Models\Resources\B2b;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserB2b extends Model
{
    use HasFactory, HasB2b;

    protected $fillable = [
        "b2b_id",
        "user_id",
        "role_id",
    ];



    public function user(){
        return $this->belongsTo(User::class, "id", "user_id");
    }

}
