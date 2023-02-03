<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
class ImageController extends Controller
{

public function store(Request $request) {

   $user = auth()->user();
   if ($user->role->name != 'admin') {
       return response(['message' => 'Unauthorized'], 401);
   }else {
      $allowedfileExtension = ['pdf', 'jpg', 'png'];
      $files = $request -> file('image');
      $errors = [];
      foreach($files as $file) {

         $extension = $file -> getClientOriginalExtension();
   
         $check = in_array($extension, $allowedfileExtension);
   
         if ($check) {
            foreach($request -> image as $mediaFiles) {
   
               $path = $mediaFiles -> store('public/images');
               $name = $mediaFiles -> getClientOriginalName();
   
               //store image file into directory and db
               $save = new Image();
               // $save -> title = $name;
               $save -> path = $path;
               $save -> save();
            }
         } else {
            return response() -> json(['invalid_file_format'], 422);
         }
   
         return response() -> json(['file_uploaded'], 200);
   
      }
   }


  
}

}

