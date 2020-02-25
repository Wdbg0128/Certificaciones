<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class controlUsuariosControllers extends Controller
{

public function postGuzzleRequest(request $request){
        $client = new \GuzzleHttp\Client();
        $url = "http://192.168.50.100:8065/login";
        $request = $client->request('POST', $url, [
        'form_params' => [
        'username' => $request->username,
        'password'=> $request->password,
        ]
    ]);
        $response = $request->getBody()->getContents();
        return response()->json($response);
    }

    public function permisosUsername(request $request)
    {
        $usuario = $request->username;

        $arr_prodect_seg = DB::connection('sqlsrv_seg')->select('SELECT * FROM PERMISOS_APLICACIONES_View WHERE (USUARIO = ? AND ID_APL = ?)', [$usuario , '2003']);
        return response()->json($arr_prodect_seg);
    }
}
