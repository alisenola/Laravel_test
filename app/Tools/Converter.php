<?php

namespace App\Tools;
use AmrShawky\LaravelCurrency\Facade\Currency;

class Converter
{  
    /**
    * Get the base64 code of image
    * @param string $path
    *
    * @return string
    */
    public static function convert_into_base64($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION); #Get product image type
        $data = file_get_contents($path); #Get the product image
        $imageBase64 = "data:image/$type;base64," . base64_encode($data); #Convert product image to base64
        return "$imageBase64";
    }
}