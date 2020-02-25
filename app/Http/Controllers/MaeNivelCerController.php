<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mae_nivel_cer;
use Complex\Exception;
use Illuminate\Http\Request;

class MaeNivelCerController extends Controller
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
            $nivelCer = Mae_nivel_cer::where('id', 'LIKE', "%$keyword%")
                ->orWhere('nombre_nivel_cer', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $nivelCer = Mae_nivel_cer::latest()->paginate($perPage);
        }

        return view('Cotecmar.mae-nivel-cer.index', compact('nivelCer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Cotecmar.mae-certificados.create');
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

        Mae_nivel_cer::create($requestData);

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
        $nivelCer = Mae_nivel_cer::findOrFail($id);

        return view('Cotecmar.mae-certificados.show', compact('maecertificado'));
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
        $nivelCer = Mae_nivel_cer::findOrFail($id);

        return view('Cotecmar.mae-nivel-cer.edit', compact('nivelCer'));
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

        $nivelCer = Mae_nivel_cer::findOrFail($id);
        $nivelCer->update($requestData);

        return redirect('Cotecmar/mae-nivel-cer')->with('success', 'Nivel modificado updated!');
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
            Mae_nivel_cer::destroy($id);
            return redirect('Cotecmar/mae-nivel-cer')->with('success', 'deleted!');
        }
        catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
