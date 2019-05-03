<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index(Request $request){
        //
    }

    public function upload(Request $request)
    {
        $image_url = null;
        if($request->has('file')) {
            // Get file name with extensions
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //Move Uploaded File
            $destinationPath = 'uploads';
            $file->move($destinationPath, $fileNameToStore);
            $image_url = $destinationPath.'/'.$fileNameToStore;
        }

        return $image_url;
    }
}
