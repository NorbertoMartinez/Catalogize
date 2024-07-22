<?php


namespace App\Catalogize\Traits;


trait Publishable
{


    public function initializePublishable()
    {
        $this->append('published');
    }

    /**
     * @param $published
     */
    public function publish_toogle($published){

        $this->status_id = ($published)?2:1;
        $this->save();
    }

    /**
     * @return bool
     */
    public function getPublishedAttribute(){

        return ($this->status_id == 1)?true:false;
    }

}
