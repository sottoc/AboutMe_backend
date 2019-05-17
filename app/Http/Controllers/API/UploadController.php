<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function index(Request $request){
        //
    }

    public function upload(Request $request)
    {
        $image_url = null;
        if($request->has('file')) {
            $file = $request->file;
            if (preg_match('/^data:image\/(\w+);base64,/', $file)) {
                $data = substr($file, strpos($file, ',') + 1);
                $data = base64_decode($data);
                $file_type = $request->file_type;
                $extension = explode("/", $file_type)[1];
                $filename = $request->file_name;
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                Storage::disk('local')->put('public/uploads/'.$fileNameToStore, $data);
                $image_url = Storage::url('public/uploads/'.$fileNameToStore);
            }
        }
        return $image_url;
    }

    public function uploadSave(Request $request)
    {
        $image_url = null;
        if($request->has('file')) {
            $file = $request->file;
            if (preg_match('/^data:image\/(\w+);base64,/', $file)) {
                $data = substr($file, strpos($file, ',') + 1);
                $data = base64_decode($data);
                $file_type = $request->file_type;
                $extension = explode("/", $file_type)[1];
                $filename = $request->file_name;
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                Storage::disk('local')->put('public/uploads/'.$fileNameToStore, $data);
                $image_url = Storage::url('public/uploads/'.$fileNameToStore);
            }

        }
        $username = $request->username;
        DB::table('profile')->where('username', '=', $username)->update(array('avatar' => $image_url));
        return $image_url;
    }

}
