<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MaeCertificado;
use Complex\Exception;
use Illuminate\Http\Request;

class MaeCertificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $username = $request->username;
        $registro = $request->registro;
        $certificado = $request->certificado;
        $ente_certificador = $request->ente_certificador;
        $nivel = $request->nivel;
        $tipo_certificado = $request->tipo_certificado;
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $maecertificados = MaeCertificado::where('Nombre_Certificado', 'LIKE', "%$keyword%")
                ->orWhere('Vigencia', 'LIKE', "%$keyword%")
                ->orWhere('Estado', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $maecertificados = MaeCertificado::latest()->paginate($perPage);
        }

        return view('Cotecmar.mae-certificados.index', compact('maecertificados','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $username = $request->username;
        $registro = $request->registro;
        $certificado = $request->certificado;
        $ente_certificador = $request->ente_certificador;
        $nivel = $request->nivel;
        $tipo_certificado = $request->tipo_certificado;
        return view('Cotecmar.mae-certificados.create',compact('username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        MaeCertificado::create($requestData);

        return redirect('Cotecmar/mae-certificados')->with('flash_message', 'MaeCertificado added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $maecertificado = MaeCertificado::findOrFail($id);

        return view('Cotecmar.mae-certificados.show', compact('maecertificado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $username = $request->username;
        $registro = $request->registro;
        $certificado = $request->certificado;
        $ente_certificador = $request->ente_certificador;
        $nivel = $request->nivel;
        $tipo_certificado = $request->tipo_certificado;

        $maecertificado = MaeCertificado::findOrFail($id);

        return view('Cotecmar.mae-certificados.edit', compact('maecertificado','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $maecertificado = MaeCertificado::findOrFail($id);
        $maecertificado->update($requestData);

        return redirect('Cotecmar/mae-certificados')->with('flash_message', 'MaeCertificado updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            MaeCertificado::destroy($id);
            return redirect('Cotecmar/mae-certificados')->with('flash_message', 'MaeCertificado deleted!');
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
