<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 14.04.2018
 * Time: 21.46
 */

namespace skirenndatabase;


class InputSanitizer
{

    public static function sanitizeInput($input){
        if($input == null || $input == ""){
            return false;
        }
        $input = filter_var($input, FILTER_SANITIZE_STRING);
        if($input == false){
            return false;
        }
        else{
            return $input;
        }
    }

}