<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MaeEnteCertificador;
use Complex\Exception;
use Illuminate\Http\Request;

class MaeEnteCertificadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $maeentecertificador = MaeEnteCertificador::where('Nombre_EnteCertificador', 'LIKE', "%$keyword%")
                ->orWhere('Estado', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $maeentecertificador = MaeEnteCertificador::latest()->paginate($perPage);
        }

        return view('Cotecmar.mae-ente-certificador.index', compact('maeentecertificador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Cotecmar.mae-ente-certificador.create');
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

        MaeEnteCertificador::create($requestData);

        return redirect('Cotecmar/mae-ente-certificador')->with('flash_message', 'MaeEnteCertificador added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('Cotecmar.mae-ente-certificador.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $maeentecertificador = MaeEnteCertificador::findOrFail($id);

        return view('Cotecmar.mae-ente-certificador.edit', compact('maeentecertificador'));
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

        $maeentecertificador = MaeEnteCertificador::findOrFail($id);
        $maeentecertificador->update($requestData);

        return redirect('Cotecmar/mae-ente-certificador')->with('flash_message', 'MaeEnteCertificador updated!');
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
            MaeEnteCertificador::destroy($id);
            return redirect('Cotecmar/mae-ente-certificador')->with('flash_message', 'MaeEnteCertificador deleted!');
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
