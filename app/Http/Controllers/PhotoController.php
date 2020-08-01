<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
Use DB;


class PhotoController extends Controller
{
    public function profileImage($fileName){
        $path = public_path().'/storage/images/'.$fileName;
        return Response::download($path);
    }

    public function propertyImage($fileName){
        $path = public_path().'/images/propertyImages/'.$fileName;
        // $path = public_path().'/storage/images/propertyImages/'.$fileName;
        return Response::download($path);
    }
}
