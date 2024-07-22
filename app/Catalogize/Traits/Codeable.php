<?php


namespace App\Catalogize\Traits;


use Illuminate\Support\Facades\Hash;

trait Codeable
{
    public function gen_qr(){
        $this->hash = Hash::make($this->id.$this->b2b->b2b_hash);
        $this->save();
    }
}
