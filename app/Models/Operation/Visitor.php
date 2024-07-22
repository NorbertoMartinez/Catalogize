<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;


    protected $fillable = [
        "location",
        "timezone",
        "referer",
        "time_active",
        "hot_zones",
        "clicks",
        "isGuest",
        "view_builder_id",
        "status_id",
    ];
}
