
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{asset("js/scripts.js")}}"></script>


<div class="modal fade" id="certificadosModal">
    <div class="modal-dialog" style="width: 60% !important; height:40% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                    <p class="col-md-12 col-md-offset-5">Selección de Certificado</p>
            </div>
            <div class="modal-body">
                <table id="Certificado" class="display" style="width:100%" onclick="filaCertificado();" responsive>
                    <thead>
                        <tr>
                            <th class="hidden">ID</th>
                            <th>N °</th>
                            <th>Nombre Certificado</th>
                            <th>Concepto Aptitud</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Certificados= App\MaeCertificado::all();
                        ?>
                        @foreach($Certificados as $item)
                        <?php
                        $Concepto="No Requiere";
                        if($item->concepto_aptitud==1){
                            $Concepto="Requiere";
                        }
                        ?>
                        <tr class="{{($item->Estado==1)?'':'hidden'}}" id="tr" >
                            <td class="hidden">{{$item->id}}</td>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->Nombre_Certificado}}</td>
                            <td>{{$Concepto}}</td>
                        <td> @if ($item->Estado==1)
                                <img title="Activo" src="{{asset("assets/$theme/dist/img/checked_checkbox_35px.png")}}" id="" class=" rounded float-left img-fluid" alt="list-style-image" width="25px";> Activo
                        @else
                                <img title="Inactivo" src="{{asset("assets/$theme/dist/img/close_window_35px.png")}}" id="" class=" rounded float-left img-fluid" alt="..." width="25px";> Inactivo
                        @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <div class="col-md-3">
                    <b>Certificado Seleccionado:</b>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="NombreCer1" readonly>
                </div>
                <div class="col-md-3">
                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Seleccionar">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Datos Personales --}}

<div class="modal fade" id="dp">
    <div class="modal-dialog" style="width: 60% !important; height:40% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                <p class="text-center">Selección de Colaborador</p>
            </div>
            <div class="modal-body">
                <?php
                // $DATOS= CerRegistro::datosPersonalesTODOS();
                   $datos = DB::connection('sqlsrv_sap')
                    ->select('SELECT NUM_SAP,
                    IDENTIFICACION,
                    APELLIDOS_NOMBRES,
                    INF_ORGANIZACIONAL_PA0001_View.BTRTL
                    FROM LISTADO_PERSONAL_SAP_ACTIVOS_View
                    JOIN INF_ORGANIZACIONAL_PA0001_View ON LISTADO_PERSONAL_SAP_ACTIVOS_View.NUM_SAP =
                    INF_ORGANIZACIONAL_PA0001_View.PERNR');
                ?>
                <table id="Personas" class="display" style="width:100%" responsive>
                    <thead>
                        <tr>
                            <th>Num SAP</th>
                            <th>Apellidos y Nombres</th>
                            <th>Cedula</th>
                            <th>Dependencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $item)
                        <tr id="tr" onclick="filaPersona();">
                            <td>{{$item->NUM_SAP}}</td>
                            <td>{{$item->APELLIDOS_NOMBRES}}</td>
                            <td>{{$item->IDENTIFICACION}}</td>
                            <td>{{$item->BTRTL}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <div class="modal-footer text-center">
                    <div class="col-md-3">
                        <b>Colaborador Seleccionado:</b>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="Apellidos_Nombres1" readonly>
                    </div>
                    <div class="col-md-3">
                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Seleccionar">
                    </div>
                </div>
        </div>
    </div>
</div>
