<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DatosPersonale;
use Illuminate\Http\Request;

class DatosPersonalesController extends Controller
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
            $datospersonales = DatosPersonale::where('Num_Sap', 'LIKE', "%$keyword%")
                ->orWhere('Identificacion', 'LIKE', "%$keyword%")
                ->orWhere('Apellidos_Nombres', 'LIKE', "%$keyword%")
                ->orWhere('Gerencia', 'LIKE', "%$keyword%")
                ->orWhere('Planta', 'LIKE', "%$keyword%")
                ->orWhere('Cargo', 'LIKE', "%$keyword%")
                ->orWhere('Fin_Contrato', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $datospersonales = DatosPersonale::latest()->paginate($perPage);
        }

        return view('Cotecmar.datos-personales.index', compact('datospersonales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Cotecmar.datos-personales.create');
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

        DatosPersonale::create($requestData);

        return redirect('Cotecmar/datos-personales')->with('flash_message', 'DatosPersonale added!');
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
        $datospersonale = DatosPersonale::findOrFail($id);

        return view('Cotecmar.datos-personales.show', compact('datospersonale'));
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
        $datospersonale = DatosPersonale::findOrFail($id);

        return view('Cotecmar.datos-personales.edit', compact('datospersonale'));
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

        $datospersonale = DatosPersonale::findOrFail($id);
        $datospersonale->update($requestData);

        return redirect('Cotecmar/datos-personales')->with('flash_message', 'DatosPersonale updated!');
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
        DatosPersonale::destroy($id);

        return redirect('Cotecmar/datos-personales')->with('flash_message', 'DatosPersonale deleted!');
    }
}
