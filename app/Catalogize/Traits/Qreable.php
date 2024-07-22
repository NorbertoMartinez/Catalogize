<?php


namespace App\Catalogize\Traits;


use Illuminate\Support\Facades\Hash;

trait Qreable
{
    public function gen_hash(){
        $this->hash = Hash::make(
            $this->id.time());
        $this->save();
    }

    public function gen_qr(){

        if(!$this->hash)
            self::gen_hash();

        $this->qr_code = base64_encode(\QrCode::format('png')->size(500)->generate(
            \Request::root()."/".base64_encode($this->hash)
        ));

        $this->save();
    }
}
