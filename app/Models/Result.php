<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    const OK = "success";
    const ERROR = "error";
    const WARNING = "warning";

    public static function make($status = null, $data = null){
        return response()->json([
           "status" => ($status)?$status:self::ERROR,
           "data" => $data,
        ]);
    }


}
