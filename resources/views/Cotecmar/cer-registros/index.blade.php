@extends("theme.$theme.layout")

@section('styles')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{asset("js/scripts.js")}}"></script>
@endsection
@section('content')

    <div class="box" id="box1">
        <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        @section('Name_Vista')
                        <a href="/inicio" title="Ir a Inicio">
                            <form method="GET" action="{{ url('/inicio') }} " enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="username" type="hidden" value="{{ $username }}">  
                                <input name="registro"type="hidden" value="{{$registro}}">
                                <input name="certificado"type="hidden" value="{{$certificado}}">
                                <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                                <input name="nivel"type="hidden" value="{{$nivel}}">
                                <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                                <button class="btn" id="button" type="submit" onclick="return confirm(&quot; ¿Desea ir al inicio? !No se guardaran los cambios realizados¡&quot;)">
                                    <img src="{{asset("assets/$theme/dist/img/home_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></button>
                              </form>
                        </a>
                        Registro de Certificados
                        @endsection</div>
                        <div class="card-body">
                            <table id="TodosRedistros" class="display" style="width:100%; height:40% !important;" responsive>
                                <thead>
                                    <tr>
                                        <th title="Apellidos y Nombres">Nombre y Apellidos</th>
                                        <th title="Cedula de Ciudadania">Cedula</th>
                                        <th title="Gerencia a la que pertenece">Gerencia</th>
                                        <th title="Tipo de certificación">Tipo Cer.</th>
                                        <th title="Nombre del Certificado">Nombre Cer.</th>
                                        <th title="Nivel de la Certificación">Nivel Cer.</th>
                                        <th title="Fecha de Vencimiento del certificado">Fecha Vencimiento</th>
                                        <th title="Dias vigentes">Dias de vigencia</th>
                                        <th title="Estado del Certificado">Estado</th>
                                        <th title="Ver">VER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cerregistros->sortBy('fecha_Fin')  as $item)
                                    <?php
                                        $id="tr";
                                        $Estado="";
                                        $E="";
                                        $fechaFIN= Carbon\Carbon::createFromDate($item->fecha_Fin);
                                        $diasDiferencia = $fechaFIN->diffInDays($fechahoy= Carbon\Carbon:: Now());
                                         if ($fechaFIN<$fechahoy && $diasDiferencia>0){
                                            $Estado="Vencido";
                                            $id="trV";
                                            $E="-";
                                        } elseif ($diasDiferencia<=30 && $diasDiferencia>=0 && isset($item->fecha_Expedicion)) {
                                           $E="";
                                           $Estado="Por Vencer";
                                           $id="trXV";
                                        }elseif($diasDiferencia==0){
                                            $E="";
                                            $Estado="Requiere";
                                            $id="trR";
                                        }else {
                                           $E="";
                                           $Estado="Vigente";
                                        }
                                        $Gerencia="No found";
                                        if (isset($item->DatosPersonalesSAP()->getData()[0]->GERENCIA)) {
                                            $Gerencias=$item->DatosPersonalesSAP()->getData()[0]->GERENCIA;
                                            if ($Gerencias == "CONS") //GERENCIA CONSTRUCCIONES
                                                $Gerencia= "GECON";
                                            if ($Gerencias == "DESI") //GERENCIA DE CIENCIA, TECNOLOGIA E INNOVACION
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
                                    ?>
                                    <tr  id="{{isset($item->archivo)? $id : 'narchivos'}}">
                                        <td>{{isset($item->DatosPersonalesSAP()->getData()[0]->APELLIDOS_NOMBRES) ? $item->DatosPersonalesSAP()->getData()[0]->APELLIDOS_NOMBRES : 'No found'}}</td>

                                        <td>{{isset($item->DatosPersonalesSAP()->getData()[0]->IDENTIFICACION) ? $item->DatosPersonalesSAP()->getData()[0]->IDENTIFICACION : 'No found'}}</td>

                                        <td>{{$Gerencia}}</td>

                                        <td>{{isset($item->tipocertificado()->first()->nombre_tipo_cer) ? $item->tipocertificado()->first()->nombre_tipo_cer : 'No found'}}</td>
                                        <td>{{isset($item->certificado()->first()->Nombre_Certificado) ? $item->certificado()->first()->Nombre_Certificado : 'No found'}}</td>
                                        <td>{{isset($item->nivelcertificado()->first()->nombre_nivel_cer) ? $item->nivelcertificado()->first()->nombre_nivel_cer : 'No found'}}</td>
                                        <td>{{isset($item->fecha_Fin)?$item->fecha_Fin:'0000-00-00'}}</td>
                                        <td>{{isset($item->fecha_Expedicion)?$E.$diasDiferencia.' Dia(s)':'Requiere'}}</td>
                                        <td>{{$Estado}}</td>
                                        <td>
                                            <a title="Ver">
                                                <form method="GET" action="{{ url('/Cotecmar/cer-registros/' . $item->id) }} " enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input name="username" type="hidden" value="{{ $username }}">  
                                                    <input name="registro"type="hidden" value="{{$registro}}">
                                                    <input name="certificado"type="hidden" value="{{$certificado}}">
                                                    <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                                                    <input name="nivel"type="hidden" value="{{$nivel}}">
                                                    <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                                                    <button class="btn" id="button" type="submit">
                                                        <img src="{{asset("assets/$theme/dist/img/eye_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="40px"; id="button-back">
                                                    </button>
                                                  </form>
                                            </a>
                                            {{-- <a href="{{ url('/Cotecmar/cer-registros/' . $item->id) }}" title="Ver Registro"><img id="button-action"src="{{asset("assets/$theme/dist/img/eye_50px.png")}}" class="rounded float-left img-fluid" alt="..." width="50px"></a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-12 col-md-offset-5">
        <a title="Agregar Nuevo Registro">
            <form method="GET" action="{{ url('/Cotecmar/cer-registros/create') }} " enctype="multipart/form-data">
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
              </form>
        </a>
        {{-- <a title="Agregar Nuevo Registro">
            <form method="GET" action="{{ url('/Cotecmar/cer-registros/create') }} " enctype="multipart/form-data">
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
              </form>
        </a> --}}
    <a class="btn" href="{{ route('CerRegistro.excel') }}" title="Exportar documento .xlsx" onclick="return confirm('¿Desea descargar un archivo de excel?');" >
        <img src="{{asset("assets/$theme/dist/img/microsoft_excel_100px.png")}}" id="button-action" class="rounded float-left img-fluid" alt="..." width="80px"; style="margin-left:2%;">
    </a>
   </div>
@endsection

