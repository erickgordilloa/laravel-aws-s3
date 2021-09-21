<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    //
    public function index()
    {
        return 'Hola mundo';
    }

    public function store(Request $request)
    {
  
        $path = $request->file('image')->store('ruta_tenant/materiales', 's3'); 

        return response()->json([
            'route' => $path,
            'name' => basename($path),
            'url' =>  Storage::disk('s3')->url($path)
        ]);
    }

    public function show()
    {
        try {
            $nombre_archivo = 'cMIVjtjmFTpmmfeTvzMkhMahBHrl3dQtUZxW7SFA.pdf';
            return Storage::disk('s3')->response('ruta_tenant/materiales/'.$nombre_archivo);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'not found',
                'stack' => json_decode($th),
            ]);
        }
    } 
}
