<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 7:25 PM
 */

namespace App\Traits;


trait WithTrait
{
    public function scopeWantByInclude($query,$withs = array())
    {
        if(!empty($withs) && !empty($this->withAvailables)){

            if(!is_array($withs)){
                $withs = explode(",",$withs);
            }

            $argument = array();

            foreach ($withs as $with){

                if(in_array($with,$this->withAvailables)){
                    $argument[] =  $with;
                }

            }

            $query->with($argument);
        }

        return $query;
    }
}