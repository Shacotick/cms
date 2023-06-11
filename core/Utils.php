<?php

namespace core;

class Utils
{
    public static function filterArray($array, $fieldsList)
    {
        $filtedArray = [];
        foreach($array as $key => $value)
            if(in_array($key, $fieldsList))
                $filtedArray[$key] = $value;
        return $filtedArray; 
    }
}