<?php

namespace App\Models\Catalogs;

use Database\Seeders\Catalogs\BussinessTypeCatalogTypeSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinessType extends Model
{
    use HasFactory;

    public function status(){
        return $this->hasOne(Status::class, "id", 'status_id');
    }

    public function catalogsTypes(){
        return $this->hasMany(BussinessTypeCatalogType::class,
        "bussiness_type_id",'id');
    }

}
