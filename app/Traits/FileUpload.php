<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Config;
use File; 
trait FileUpload {

    public function uploadFile($file,$type){
        
        switch($type){
            case 'proof':
            $path = Config::get('constants.file.proof_file_path');
            break;
            case 'user':
            $path = Config::get('constants.file.user_file_path');
            break;
            default:
            $path = '';    
        }
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        if(!empty($file)){ 
            $fileName = time().'-'.$type.'.'.$file->extension();
            $file->move(public_path($path), $fileName);
            return $fileName;
        }
        return false;
    }
    public function removeFile($file,$type){
        
        switch($type){
            case 'proof':
            $path = Config::get('constants.file.proof_file_path');
            break;
            case 'user':
            $path = Config::get('constants.file.user_file_path');
            break;
            default:
            $path = '';     
        }
        if(!empty($file) && File::exists(public_path($path.'/'.$file))){
            unlink(public_path($path.'/'.$file)); 
        }
    }
}