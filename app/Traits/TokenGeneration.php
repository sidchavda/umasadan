<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\User;
trait TokenGeneration {

    public static function createToken($data){
        // Convert the data to JSON format
        $jsonData = json_encode($data);
        // Encode the JSON data using Base64
        $encodedData = base64_encode($jsonData);
        $hash = hash('sha256', $encodedData . config('constants.secret_key'));
        // Combine the encoded data and hash as a token
        $token = $encodedData . '.' . $hash;
        return $token;
    }

    public static function decodeToken($token) {
        // Separate the token into encoded data and hash
        list($encodedData, $hash) = explode('.', $token, 2);
        // Verify the hash
        $expectedHash = hash('sha256', $encodedData . config('constants.secret_key'));
        if ($hash !== $expectedHash) {
          return false; // Invalid token
        }
        // Decode the Base64 data
        $jsonData = base64_decode($encodedData);
        // Convert JSON data to array
        $data = json_decode($jsonData, true);
        return $data;
    }
    
    public static function getUserDetail(string $token){ 
      $userId = self::decodeToken($token);
      if(is_int($userId)){
        return  User::where('id',$userId)->first();
      }
      return array();
    }
        
}

?>