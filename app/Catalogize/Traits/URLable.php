<?php

namespace App\Catalogize\Traits;

trait URLable
{

    public function initializeURLable()
    {
        $this->append('url');
    }


    /**
     * Attribute URL generator
     * @return string
     */
    public function getUrlAttribute(){
        return \Request::root()."/viewer/scene/?d=".base64_encode($this->hash);
    }

}
