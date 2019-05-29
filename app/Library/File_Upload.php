<?php 

namespace App\Library;
use Input;

class File_upload
{
    public function __construct()
    {
    }

    public function image_upload($image_name)
    {
        $destinationPath = 'img';
        $extension = Input::file($image_name);
        if($extension!==null){
            $extension = Input::file($image_name)->getClientOriginalExtension(); 

            $image = rand(11111,99999).'.'.$extension;

            Input::file($image_name)->move($destinationPath, $image); 
            return $image;
        }
        else{
            $fil_ext=null;
        }

        
    }

    public function pdf_upload($pdf_name)
    {
        $destinationPath = 'pdf';
        $extension = Input::file($pdf_name);
        if($extension!==null){
           $extension = Input::file($pdf_name)->getClientOriginalExtension(); 

            $pdf = rand(11111,99999).'.'.$extension;

            Input::file($pdf_name)->move($destinationPath, $pdf); 
            return $pdf; 
        }
        else{
            $fil_ext=null;
        }
        
    }
}
?>
