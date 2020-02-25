@extends("theme.$theme.layout")

@section('styles')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection

@section('scripts')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    @section('Name_Vista')
                    <div  class="card-header" >
                    <a href="{{ url('/Cotecmar/cer-registros') }}"  title="Ir Atras">
                        <img src="{{asset("assets/$theme/dist/img/long_arrow_left_100px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                        <a href="/inicio" title="Ir a Inicio"><img src="{{asset("assets/$theme/dist/img/home_50px.png")}}"  class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                        <a href="{{ url('/Cotecmar/cer-registros/'. $cerregistro->id .'/edit') }}" title="Editar Registro"> <img src="{{asset("assets/$theme/dist/img/edit_file_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="40px"; id="button-back"></a>
                        
                        
                        <form method="POST" action="{{ url('/Cotecmar/cer-registros/'.$cerregistro->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input name="username" type="hidden" value="{{ $username }}">  
                            <input name="registro"type="hidden" value="{{$registro}}">
                            <input name="certificado"type="hidden" value="{{$certificado}}">
                            <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                            <input name="nivel"type="hidden" value="{{$nivel}}">
                            <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                            <button id="button" class="btn" type="submit" title="Eliminar Registro"> <img src="{{asset("assets/$theme/dist/img/delete_file_50px.png")}}" class="rounded float-left img-fluid" alt="..." width="40px"; id="button-back" onclick="return confirm(&quot;Confirmar la eliminacion?&quot;)"></button>
                        </form>

                        {{-- <form method="GET" action="{{ url('/Cotecmar/cer-registros/create') }} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="username" type="hidden" value="{{ $username }}">  
                            <input name="registro"type="hidden" value="{{$registro}}">
                            <input name="certificado"type="hidden" value="{{$certificado}}">
                            <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                            <input name="nivel"type="hidden" value="{{$nivel}}">
                            <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                            <button class="btn" id="button" type="submit">
                                <img src="{{asset("assets/$theme/dist/img/add_file_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="80px"; id="button-back">
                            </button>
                          </form> --}}
                        <div style="text-align: center;">
                        Visualización de Certificado y constancias
                    </div>
                    </div>@endsection
                </div>
            </div>
        </div>
    </div>
    <div>
</div>
     <!------ Include the above in your HEAD tag ---------->
        <?php
                $nombreCer = app\MaeCertificado::where( 'id',$cerregistro->maecertificado_id);
                $cerregistros= $cerregistro->where('id',$cerregistro->id);
                $fechaFIN= Carbon\Carbon::createFromDate($cerregistros->first()->fecha_Fin);
                $diasDiferencia = $fechaFIN->diffInDays($fechahoy = Carbon\Carbon:: Now());
                if ($fechaFIN<$fechahoy && $diasDiferencia>0){
                $Estado="Vencido";
                $E="-";
                } elseif ($diasDiferencia<=30 && $diasDiferencia>=0 && isset($item->fecha_Expedicion)) {
                   $E="";
                   $Estado="Por Vencer";
                }elseif($diasDiferencia==0){
                    $E="";
                    $Estado="Requiere";
                }else {
                   $E="";
                   $Estado="Vigente";
                }
                $Gerencia="No found";
                if (isset($cerregistro->DatosPersonalesSAP()->getData()[0]->GERENCIA)) {
                     $Gerencias=$cerregistro->DatosPersonalesSAP()->getData()[0]->GERENCIA;
                     if ($Gerencias == "CONS") //GERENCIA CONSTRUCCIONES
                         $Gerencia= "GECON";
                     if ($Gerencias == "DESI") //DIDESI NO EXISTE
                         $Gerencia = "DIDESI";
                     if ($Gerencias == "CTIN") //GERENCIA DE CIENCIA, TECNOLOGIA E INNOVACION
                         $Gerencia = "GECTI";
                     if ($Gerencias == "DING") //GERENCIA DISEÑO E INGENIERIA
                         $Gerencia ="GEDIN";
                     if ($Gerencias == "FADM") //GERENCIA FINANCIERA Y ADMINISTRATIVA
                         $Gerencia= "GEFAD";
                     if ($Gerencias == "BGDE") //GERENCIA PLANTA BOCAGRANDE
                         $Gerencia= "GEBOC";
                     if ($Gerencias == "MNAL") //GERENCIA PLANTA MAMONAL
                         $Gerencia = "GEMAM";
                     if ($Gerencias == "THUM") //GERENCIA TALENTO HUMANO
                         $Gerencia= "GETHU";
                     if ($Gerencias == "VICO") //GERENCIA PLANTA BOCAGRANDE
                         $Gerencia = "VPT&O";
                     if ($Gerencias == "PRES") //GERENCIA PLANTA MAMONAL
                         $Gerencia= "PCTMAR";
                     if ($Gerencias == "VICE") //GERENCIA TALENTO HUMANO
                         $Gerencia= "VPEXE";
                 }
                 $Sede="No found";
                 if (isset($cerregistro->DatosPersonalesSAP()->getData()[0]->SEDE)) {
                    $Sedes=$cerregistro->DatosPersonalesSAP()->getData()[0]->SEDE;
                    if ($Sedes == "SMAM") //GERENCIA PLANTA BOCAGRANDE
                         $Sede = "MAMONAL";
                    if ($Sedes == "SBGD") //GERENCIA PLANTA MAMONAL
                        $Sede= "B/GRANDE";
                    if ($Sedes == "SCEN") //GERENCIA TALENTO HUMANO
                         $Sede= "CENTRO";
                    if ($Sedes == "SBOG") //GERENCIA TALENTO HUMANO
                        $Sede= "CENTRO";
                 }
                 $archivo="";
                 $archivo_concepto="";
        if (isset($cerregistros->first()->archivo)) {
            $archivo = $cerregistros->first()->archivo;
            list($storage, $carpeta, $subCarpeta, $nombreArchivo) = explode("/", $archivo);
            $archivo='public/'.$carpeta.'/'.$subCarpeta.'/'.$nombreArchivo;
        }
        if (isset($cerregistros->first()->archivo_concepto)) {
            $archivo_concepto = $cerregistros->first()->archivo_concepto;
            list($storage, $carpeta, $nombreArchivo) = explode("/", $archivo_concepto);
            $archivo_concepto='public/'.$carpeta.'/'.$nombreArchivo;
        }
        ?>
     <div role="tabpanel">
         <ul class="nav nav-tabs" role="tablist">
             <li role="presentation" class="active"><a href="#seccion1" aria-controls="seccion1" data-toggle="tab" role="tab"> Detalles del Registro</a></li>
             @if (Storage::exists($archivo))
             <li role="presentation"><a href="#seccion2" aria-controls="seccion2" data-toggle="tab" role="tab" > Constancia de Certificado</a></li>
             @endif
             @if (Storage::exists($archivo_concepto))
             <li role="presentation"><a href="#seccion3" aria-controls="seccion3" data-toggle="tab" role="tab"> Concepto de Aptitud</a></li>
             @endif
         </ul>

         <div class="tab-content text-center">
             {{-- seccion 1 --}}
             <div role="tabpanel" class="tab-pane active" id="seccion1">
                <h1>Detalles del Registro</h1>
                <div class="card-body text-center col-md-auto">
                    <div class="">
                           <table class="table">
                              <tbody>
                                    <tr>
                                        <td><b>Apellidos y Nombres</b><br>{{isset($cerregistro->DatosPersonalesSAP()->getData()[0]->APELLIDOS_NOMBRES) ? $cerregistro->DatosPersonalesSAP()->getData()[0]->APELLIDOS_NOMBRES : 'No found'}}
                                        <td><b>Numero de Sap</b> <br>{{$cerregistro->Num_Sap}}</td>
                                        <td><b>Cedula de ciudadania</b><br>{{isset($cerregistro->DatosPersonalesSAP()->getData()[0]->IDENTIFICACION) ? $cerregistro->DatosPersonalesSAP()->getData()[0]->IDENTIFICACION : 'No found'}}</td>
                                        <td><b>Dependencia</b><br>{{$Gerencia}}</td>
                                        <td><b>Planta</b><br>{{$Sede}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Nombre Certificado </b> <br>{{$cerregistro->tipocertificado()->first()->nombre_tipo_cer.' '}}<b>{{$nombreCer->first()->Nombre_Certificado}}</b> {{' Nivel '.$cerregistro->nivelcertificado()->first()->nombre_nivel_cer}}</td>
                                        <td><b>Fecha de Expedicion </b><br> {{ $cerregistro->fecha_Expedicion }} </td>
                                        <td><b>Fecha de vencimiento </b><br>{{ $cerregistro->fecha_Fin }} </td> <td><b>Dias Faltantes</b><br>{{$E . $diasDiferencia . ' Dia(s)'}}</td>
                                        <td><b>Estado</b><br> {{$Estado}}</td></tr>
                                    <tr>
                                      <td><b>Concepto Aptitud</b> <br> @if ($nombreCer->first()->concepto_aptitud==1)
                                        Requiere
                                      @else
                                        No Requiere
                                      @endif</td>
                                      <td><b>Fecha Expedición Concepto</b> <br>{{$cerregistro->fecha_exp_concepto}} </td>
                                      <td><b>Fecha Vencimiento de Concepto</b> <br>{{$cerregistro->fecha_fin_concepto}} </td>
                                      <td><b>Estado Concepto</b> <br>@if ($cerregistro->first()->concepto_aptitud==1)
                                       Apto
                                      @else
                                        No Apto
                                      @endif</td>
                                      <td><label for="observacion"  class="control-label">{{ 'Observación' }}</label><textarea class="form-control" rows="5" cols="25" readonly>{{ isset($cerregistro->observacion) ? $cerregistro->observacion : ''}}</textarea></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>

                  </div>
             </div>
             {{-- seccion 2 --}}
             <div role="tabpanel" class="tab-pane" id="seccion2">
                 <h3>Costancia de Certificado</h3>
                <iframe src="{{asset($cerregistros->first()->archivo)}}" width="70%" height="900px"></iframe>
             </div>
             {{-- seccion 3 --}}
             <div role="tabpanel" class="tab-pane" id="seccion3">
                 <h3>Concepto de Aptitud</h3>
                <iframe src="{{asset($cerregistros->first()->archivo_concepto)}}" width="70%" height="900px"></iframe>
             </div>
         </div>
     </div>
@endsection
