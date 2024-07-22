<?php

namespace App\Catalogize\Traits;

use App\Models\Catalogs\Availability;
use App\Models\Catalogs\Status;

trait HasAvailability
{

    public function availability(){
        return $this->hasOne(Availability::class, "id", 'availability_id');
    }
}
