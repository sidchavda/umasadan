<?php
if(!function_exists('convert_permission_name')){ 
    function convert_permission_name(string $string = ''){
        return strtoupper(preg_replace("/[^a-zA-Z]+/", " ", $string));
    }
}
if(!function_exists('random_number')){ 
    function random_number(){
        return mt_rand(1111,9999);
    }
}