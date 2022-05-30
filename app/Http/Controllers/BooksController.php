<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    public function addUserBooks(Request $request)
    {
         $data = $request->all();
        
          if ($thumbnail_image = $request->file('thumbnail')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $thumbnail_image->getClientOriginalExtension();
            $thumbnail_image->move($destinationPath, $profileImage);
            $data['thumbnail'] = "$profileImage";
          }

          if ($small_thumbnail_image = $request->file('small_thumbnail')) {
            $destinationPaths = 'image/';
            $profileImages = date('YmdHis') . "." . $small_thumbnail_image->getClientOriginalExtension();
            $small_thumbnail_image->move($destinationPaths, $profileImages);
            $data['small_thumbnail'] = "$profileImages";
          }
         $result =  Books::create($data);
         if($result){
            return response('Books added successfully!',200);
         }else{
            return response('Somthing went wrong!',201);
         }
    }

    public function getBooks($id)
    {
        return Books::where('user_id',$id)->get();
    }
}
