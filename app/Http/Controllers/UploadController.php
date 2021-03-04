<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->photo->store('tmp');

        return [
            "path" => $path
        ];
    }
}
