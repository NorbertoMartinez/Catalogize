<?php

namespace App\Catalogize\Traits;

use App\Models\Resources\B2b;
use Illuminate\Database\Eloquent\Builder;

trait HasB2b
{


    /**
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByB2b($query): Builder
    {
        return $query->whereIn("b2b_id",
            auth()->user()->userB2b()->pluck("b2b_id")->toArray());
    }

    public function b2b(){
        return $this->hasOne(B2b::class, "id", "b2b_id");
    }
}
