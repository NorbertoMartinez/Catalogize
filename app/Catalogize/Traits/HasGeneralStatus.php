<?php

namespace App\Catalogize\Traits;

use App\Models\Catalogs\Status;

trait HasGeneralStatus
{
    public function status(){
        return $this->hasOne(Status::class, "id", 'status_id');
    }
}
