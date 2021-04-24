<?php

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

function checkZeroFirst($string){
    if($string[0]==='0')
    {
        return substr($string,1);
    }
    return $string;
}

function generateCode(){

    return rand(1000,9999);

}

function pathName($file){
     $file->getClientOriginal();
    $extension = $file->getClientOriginalExtension();
    return $file->getFilename().'.'.$extension;
}

function getHashName($string):string {

         $item=explode('/',$string);
         return end($item);

}

function numPages($file) {
    $pdftext = file_get_contents($file);
    $count = preg_match_all("/\/Page\W/", $pdftext, $dummy);
   if(!is_null( $count)){
       return $count;
   }
   else{
       return null;
   }
}



