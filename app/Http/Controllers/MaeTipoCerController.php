<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mae_tipo_cer;
use Illuminate\Http\Request;

class MaeTipoCerController extends Controller
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
            $tipoCer = Mae_tipo_cer::where('id', 'LIKE', "%$keyword%")
            ->orwhere('nombre_tipo_cer', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tipoCer = Mae_tipo_cer::latest()->paginate($perPage);
        }

        return view('Cotecmar.mae-tipo-cer.index', compact('tipoCer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Cotecmar.mae-tipo-cer.create');
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

        Mae_tipo_cer::create($requestData);

        return redirect('Cotecmar/mae-tipo-cer')->with('success', 'Agregado!');
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
        $tipoCer = Mae_tipo_cer::findOrFail($id);

        return view('Cotecmar.mae-tipo-cer.show', compact('tipoCer'));
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
        $tipoCer = Mae_tipo_cer::findOrFail($id);

        return view('Cotecmar.mae-tipo-cer.edit', compact('tipoCer'));
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

        $tipoCer = Mae_tipo_cer::findOrFail($id);
        $tipoCer->update($requestData);

        return redirect('Cotecmar/mae-tipo-cer')->with('flash_message', 'MaeCertificado updated!');
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
        Mae_tipo_cer::destroy($id);

        return redirect('Cotecmar/mae-tipo-cer')->with('flash_message', 'MaeCertificado deleted!');
    }
}
