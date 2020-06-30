<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

trait ApiCrypt
{

   

    public function encrypt( $value)
    {
        if(is_array($value) || is_object($value)){
            $value = json_encode($value);
        }
        $value = (string) $value;

        $salt = openssl_random_pseudo_bytes(256);
        $iv = openssl_random_pseudo_bytes(16);
        $phrase = config('app.encr_phrase');
        $iterations = 999;  
        $key = hash_pbkdf2("sha512", $phrase ,$salt, $iterations, 64);

        $encrypted_data = openssl_encrypt($value, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

        $data = array("value" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
    
        return base64_encode(json_encode($data));
    }
    public function decrypt( $value)
    {
        $base= base64_decode($value);
        
        $jsondata=  json_decode( $base,true);
        try {
            
            $salt = hex2bin($jsondata["salt"]);
            $iv  = hex2bin($jsondata["iv"]);          
        } catch(Exception $e) { return null; }   
        $phrase = config('app.encr_phrase');
        $text = base64_decode($jsondata["value"]);
        
        $iterations = 999; //same as js encrypting 
    
        $key = hash_pbkdf2("sha512", $phrase, $salt, $iterations, 64);
    
        $decrypted= openssl_decrypt($text , 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);
        if(is_bool($decrypted)){
            return null;
        }
        return $decrypted;
    }

}