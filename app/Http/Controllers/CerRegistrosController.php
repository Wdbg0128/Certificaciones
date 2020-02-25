<?php

namespace App\Http\Controllers;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CerRegistro;
// use App\DatosPersonale;
use App\MaeEnteCertificador;
use App\MaeCertificado;
use Carbon\Carbon;
use App\Mae_nivel_cer;
use App\Mae_tipo_cer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CerRegistrosExport;
use App\Imports\CerRegistrosImport;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CerRegistrosController extends Controller
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

        $mae_tipo_cer= Mae_tipo_cer::all();
        $mae_nivel_cer= Mae_nivel_cer::all();
        $entecertificado=MaeEnteCertificador::all();
        $maecertificado=MaeCertificado::all();
        $cerregistros = CerRegistro::all();
        // $datosPersonales = $this->DatosPersonalesSAP();
        return view('Cotecmar.cer-registros.index', compact('cerregistros','maecertificado','entecertificado','mae_nivel_cer','mae_tipo_cer','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
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

        $mae_tipo_cer= Mae_tipo_cer::all();
        $mae_nivel_cer= Mae_nivel_cer::all();
        $entecertificado=MaeEnteCertificador::all();
        $maecertificado=MaeCertificado::all();
        return view('Cotecmar.cer-registros.create',compact('maecertificado','entecertificado','mae_nivel_cer','mae_tipo_cer','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
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


    $maecertificado = MaeCertificado::where('id' , $request->maecertificado_id)->get();

        if(isset($request->fecha_Expedicion)){
              $fechavig= new Carbon($request->fecha_Expedicion);
              $fechafin = $fechavig->addYears( $maecertificado->first()->Vigencia);
              $request->fecha_Fin=$fechafin;
        }
        if(isset($request->fecha_exp_concepto)){
             $fechavigConcepto= new Carbon($request->fecha_exp_concepto);
             $fechafinConcepto = $fechavigConcepto->addYears(1);
             $request->fecha_fin_concepto = $fechafinConcepto;
        }
        $request->validate([
            'Num_Sap'=>'required',
            'maecertificado_id'=>'required',
            'fecha_Expedicion'=>'nullable',
            'fecha_Fin'=>'nullable',
            'maeentecertificador_id'=>'nullable',
            'tipo_id'=>'required',
            'nivel_id'=>'required',
            'archivo'=>'mimes:pdf',
            'observacion'=> 'nullable',
            'concepto_aptitud'=>'required',
            'fecha_exp_concepto'=>'required',
            'archivo_concepto'=>'nullable',
            'fecha_fin_concepto'=>'nullable',
        ]);

        $requestData = array(
            'Num_Sap'=>$request->Num_Sap,
            'maecertificado_id'=>$request->maecertificado_id,
            'fecha_Expedicion'=>$request->fecha_Expedicion,
            'fecha_Fin'=>$request->fecha_Fin,
            'maeentecertificador_id'=>$request->maeentecertificador_id,
            'archivo'=>$request->archivo,
            'nivel_id'=>$request->nivel_id,
            'tipo_id'=>$request->tipo_id,
            'observacion'=>$request->observacion,
            'concepto_aptitud'=>$request->concepto_aptitud,
            'fecha_exp_concepto'=>$request->fecha_exp_concepto,
            'fecha_fin_concepto'=>$request->fecha_fin_concepto,
            'archivo_concepto'=>$request->archivo_concepto,
            );

            // $datos = $this->DatosPersonalesSAP($request->Num_Sap);
            // $datos = $datos->getData();
            //  return $datos->getData()[0]->IDENTIFICACION;
        if ($request->hasFile('archivo')) {

             $ext = $request->file('archivo')->guessExtension();
             $requestData['archivo'] = 'storage/'.$request->Num_Sap.'/Certificados'.'/' . $maecertificado->first()->Nombre_Certificado.' '.$request->Num_Sap.'.'. $ext;

             $request->file('archivo')->storeAs('public/'.$request->Num_Sap.'/Certificados',  $maecertificado->first()->Nombre_Certificado.' '.$request->Num_Sap.'.'. $ext);
         }

         if ($request->hasFile('archivo_concepto')) {
             $ext = $request->file('archivo_concepto')->guessExtension();
             $requestData['archivo_concepto'] = 'storage/'.$request->Num_Sap .'/'.'Concepto de Aptitud '.$request->Num_Sap.'.'. $ext;

             $request->file('archivo_concepto')->storeAs('public/'.$request->Num_Sap,'Concepto de Aptitud '.$request->Num_Sap.'.'. $ext);
         }
            $consultaDatos = CerRegistro::where('Num_Sap','=',$request->Num_Sap)->where('maecertificado_id','=',$request->maecertificado_id);
            if($consultaDatos->count()>0){

                // Alert::message('ERROR:[DULICATE REGISTRY 1]Ya existe este registro, no se puede agregar','danger');
                return back () -> with ( 'error' , 'ERROR[1 ¡Registro duplicado!] '.$request->Num_Sap.' ya cuenta con la cetificación ' .$maecertificado->First()->Nombre_Certificado);
            }
            else{
            // return dd($requestData);
            CerRegistro::create($requestData);
            return back()-> with('success','EXITO [Registro Exitoso] ¡Registro agregado correctamente!');
             }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id , Request $request)
    {
        $username = $request->username;
        $registro = $request->registro;
        $certificado = $request->certificado;
        $ente_certificador = $request->ente_certificador;
        $nivel = $request->nivel;
        $tipo_certificado = $request->tipo_certificado;

        $mae_tipo_cer= Mae_tipo_cer::all();
        $mae_nivel_cer= Mae_nivel_cer::all();
        $cerregistro = CerRegistro::findOrFail($id);
        $maecertificado=MaeCertificado::all();
        return view('Cotecmar.cer-registros.show', compact('cerregistro','maecertificado','mae_nivel_cer','mae_tipo_cer','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
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

        $mae_tipo_cer= Mae_tipo_cer::all();
        $mae_nivel_cer= Mae_nivel_cer::all();
        $entecertificado=MaeEnteCertificador::all();
        $cerregistro = CerRegistro::findOrFail($id);
        $maecertificado=MaeCertificado::all();
        return view('Cotecmar.cer-registros.edit', compact('cerregistro','maecertificado','entecertificado','mae_nivel_cer','mae_tipo_cer','username','registro','certificado','ente_certificador','nivel','tipo_certificado'));
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
        $maecertificado = MaeCertificado::where('id' , $request->maecertificado_id)->get();

        // $maecertificado->first()->Vigencia;

        if(isset($request->fecha_Expedicion)){

              $fechavig= new Carbon($request->fecha_Expedicion);
              $fechafin = $fechavig->addYears( $maecertificado->first()->Vigencia);
              $request->fecha_Fin=$fechafin;
        }
        if(isset($request->fecha_exp_concepto)){
            $fechavigConcepto= new Carbon($request->fecha_exp_concepto);
            $fechafinConcepto = $fechavigConcepto->addYears(1);
            $request->fecha_fin_concepto = $fechafinConcepto;
       }
        $request->validate([ //me falta
            // 'Num_Sap'=>'nullable',
            // 'maecertificado_id'=>'required',
            'fecha_Expedicion'=>'nullable',
            'fecha_Fin'=>'nullable',
            'maeentecertificador_id'=>'nullable',
            'tipo_id'=>'required',
            'nivel_id'=>'required',
            'archivo'=>'mimes:pdf',
            'observacion'=> 'nullable',
            'concepto_aptitud'=>'required',
            'fecha_exp_concepto'=>'required',
            'archivo_concepto'=>'nullable',
            'fecha_fin_concepto'=>'nullable',
        ]);
       if(isset($request->archivo)){
             $requestData=array('archivo'=>$request->archivo);
         }
         if(isset($request->archivo_concepto)){
            $requestData=array('archivo_concepto'=>$request->archivo_concepto);
        }
        $requestData = array(
            // 'Num_Sap'=>$request->Num_Sap,
            // 'maecertificado_id'=>$request->maecertificado_id,
            'fecha_Expedicion'=>$request->fecha_Expedicion,
            'fecha_Fin'=>$request->fecha_Fin,
            'maeentecertificador_id'=>$request->maeentecertificador_id,
            'nivel_id'=>$request->nivel_id,
            'tipo_id'=>$request->tipo_id,
            'observacion'=>$request->observacion,
            'concepto_aptitud'=>$request->concepto_aptitud,
            'fecha_exp_concepto'=>$request->fecha_exp_concepto,
            'fecha_fin_concepto'=>$request->fecha_fin_concepto,
        );
        if ($request->hasFile('archivo')) {

            $ext = $request->file('archivo')->guessExtension();
            $requestData['archivo'] = 'storage/'.$request->Num_Sap.'/Certificados'.'/' . $maecertificado->first() ->Nombre_Certificado.' '.$request->Num_Sap.'.'. $ext;

            $request->file('archivo')->storeAs('public/'.$request->Num_Sap.'/Certificados',  $maecertificado->first() ->Nombre_Certificado.' '.$request->Num_Sap.'.'. $ext);
            }

            if ($request->hasFile('archivo_concepto')) {
            $ext = $request->file('archivo_concepto')->guessExtension();
            $requestData['archivo_concepto'] = 'storage/'.$request->Num_Sap .'/'.'Concepto de Aptitud '.$request->Num_Sap.'.'.$ext;
            
            $request->file('archivo_concepto')->storeAs('public/'.$request->Num_Sap,'Concepto de Aptitud '.$request->Num_Sap.'.'. $ext);
            }

        $cerregistro = CerRegistro::findOrFail($id);
        $cerregistro->update($requestData);

        return redirect('/Cotecmar/cer-registros/'.$id)-> with('success','EXITO [Registro Editado] ¡Registro Editado correctamente!');
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
        // $file=CerRegistro::where('id',$id)->get();
        // if (isset($file->archivo)) {
        //     Storage::delete($file->archivo);
        // }
        $cerregistros = CerRegistro::where('id',$id)->get();
        // $maecertificado =MaeCertificado::where('id',$cerregistros->first()->maecertificado_id)->get();
        CerRegistro::destroy($id);
        return redirect('Cotecmar/cer-registros/')->with('info','[DELETE]:[Registro Eliminado] ¡Se elimino el registro! ');
    }

    // public function exportPdf(){
    //     $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    //     $mes = $meses[(Carbon::now()->format('n'))-1];
    //     $dia= Carbon::now()->format('d');
    //     $año= Carbon::now()->format('Y');
    //     $cerregistros= CerRegistro::get();
    //     $pdf = PDF::loadView('pdf.cerRegistro', compact('cerregistros'));
    //     return $pdf->download("Registro de certificados de cumplimiento legal hasta el dia $dia de $mes de $año.pdf");
    // }
    public function exportExcel(){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes = $meses[(Carbon::now()->format('n'))-1];
        $dia= Carbon::now()->format('d');
        $año= Carbon::now()->format('Y');
        return Excel::download(new CerRegistrosExport, "Registro de certificados de cumplimiento legal hasta el dia $dia de $mes de $año.xlsx");
    }

    public function importExcel(Request $request){
        $file=$request->file('file');
        Excel::import(new CerRegistrosImport, $file);
        return back();
    }

}

