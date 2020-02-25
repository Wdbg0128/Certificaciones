<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\controlUsuariosControllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function validarlogin(request $request)
    {
        $controlUsuariosControllers = new controlUsuariosControllers();
        $logueDA = $controlUsuariosControllers->postGuzzleRequest($request);
        $logueDA = $logueDA->original;


        if ($logueDA == 'true') {
            $username = $request->username;
            // return view('inicio');
            // $login = new PersonalSapController();
            $datos =  $controlUsuariosControllers->permisosUsername($request);
            // return response()->json($datos->original);
            if ($datos->original != null)
            {
                $registro = false;
                $certificado = false;
                $ente_certificador = false;
                $nivel = false;
                $tipo_certificado = false;
                $roles= $datos->original;
                foreach ($roles as $rol)
                {
                    if ($rol->ID_MOD==3018 && $rol->INGRESAR)  //&& $rol->CREAR && $rol->ELIMINAR && $rol->MODIFICAR && $rol->VISTA
                            $registro=true;
                    if ($rol->ID_MOD==3019  && $rol->INGRESAR)
                        $certificado=true;
                    if ($rol->ID_MOD==3020  && $rol->INGRESAR)
                        $ente_certificador=true;
                    if ($rol->ID_MOD==3021  && $rol->INGRESAR)
                        $tipo_certificado=true;
                    if ($rol->ID_MOD==3022  && $rol->INGRESAR)
                        $nivel=true;
                }
                
            // return response()->json($MaestrosValidacion);
                return view('inicio', compact('username', 'registro','certificado','ente_certificador','nivel','tipo_certificado'));
            } else {
                return back()->with('error', '!No tienes las credenciales requeridas para este Aplicativo¡');
            }
        } else
            return back()->with('error', '!Usuario o contraseña incorecto¡');
    }
//  Anterior  //
    // public function validarlogin(request $request)
    // {
    //     $username = $request->username;
    //     $controlUsuariosControllers = new controlUsuariosControllers();
    //     $logueDA = $controlUsuariosControllers->postGuzzleRequest($request);
    //     $logueDA = $logueDA->original;
    //     // return response()->json($username);


    //     if ($logueDA == 'true') {
    //         $controlUsuariosControllers = new controlUsuariosControllers();
    //         $datos =  $controlUsuariosControllers->permisosUsername($username);

    //     return response()->json($datos);
    //         if ($datos->original != null)
    //         {
    //             $MaestrosValidacion=false;
    //             $Investigador = false;
    //             foreach ($datos->original as $rol)
    //             {
    //                 if ($rol->ID_MOD==6)
    //                     if ($rol->INGRESAR && $rol->CREAR)
    //                         $Investigador=true;
    //                 if ($rol->ID_MOD==1018 && $rol->INGRESAR)
    //                     $MaestrosValidacion=true;
    //             }
    //         // return response()->json($MaestrosValidacion);
    //         // $roles= $datos->original;
    //         return view('web.index', compact('username', 'MaestrosValidacion', 'Investigador'));
    //         } else {
    //             return back()->with('Mensaje', 'No tiene permiso para acceder a la aplicacion ');
    //         }
    //     } else
    //         return back()->with('Mensaje', 'Usuario o CONTRASEÑA Incorectos ');
    // }
}
