<?php


namespace App\Catalogize\Interfaces;


interface ResourceInterface
{
    /**
     * @return mixed
     */
    public function resource();

    /**
     * @return mixed
     */
    public function resource_detail($id);
}
