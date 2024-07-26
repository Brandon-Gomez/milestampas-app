<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UploadRequest;

class UploadController extends Controller
{
    public function uploadProduct(UploadRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('products', 'public'); // Guarda el archivo en el disco 'public' en una carpeta 'uploads'

            return response()->json([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize(),
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    
}
