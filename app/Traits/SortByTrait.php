<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 7:25 PM
 */

namespace App\Traits;


trait SortByTrait
{
    protected  $sortAvailableOption = array('asc','desc');

    public function scopeCustomOrderBy($query,$sortField = 'created_at',$sortType = 'desc')
    {

        if(!empty($this->defaultSortingField)){
            $sortField = $this->defaultSortingField;
        }

        if(!empty($this->defaultSortingType)){
            $sortType = $this->defaultSortingType;
        }

        if(!empty($this->sortAvailableFields)){

            if(in_array($sortField,$this->sortAvailableFields)){

                if(in_array($sortType,$this->sortAvailableOption)){

                    $query->orderBy($sortField,$sortType);
                }

            }

        }

        return $query;
    }
}