<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GdriveController extends Controller
{
    //
    public function upload()
    {
        $path = public_path().'/'.'file.jpg';
        $filename = 'file.jpg';

        Storage::disk('google')->put($filename, File::get($path));

        return response()->json(['success'=> true]);
    }

}
