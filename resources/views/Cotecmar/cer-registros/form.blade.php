<link rel="stylesheet" href="{{asset("css/style.css")}}">
<?php
if ($formMode === 'edit'){
$nombreCer = app\MaeCertificado::where( 'id',$cerregistro->first()->maecertificado_id)->get();
}
?>
<div class="container col-md-offset-2 col-xs-12 resposive">
    <div class="form-group{{ $errors->has('Num_Sap') ? 'has-error' : ''}} col-md-7 mb-3 " >
        <label for="Apellidos_Nombres" class="control-label">{{ 'Colaborador' }}</label>
        <div class="input-group">
            <input class="form-control" type="text" id="{{ $formMode === 'edit' ? '' : 'Apellidos_Nombres' }}" name="{{ $formMode === 'edit' ? '' : 'Apellidos_Nombres' }}" value="{{ isset($cerregistro->Num_Sap) ?$cerregistro->Num_Sap.' | ' .$cerregistro->DatosPersonalesSAP()->getData()[0]->APELLIDOS_NOMBRES : ''}}" readonly required placeholder="NUM_SAP | APELLIDOS Y NOMBRES">
            <span class="input-group-btn">
                <button class="btn btn-default" id="button" type="button" title="Seleccionar Colaborador" data-toggle="modal" data-target="#dp" {{ $formMode === 'edit' ? 'disabled' : '' }}><i class="fa fa-user-plus"></i></button>
            </span>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="form-group {{ $errors->has('maecertificado_id') ? 'has-error' : ''}} col-md-4 mb-3">
        <label for="">Nombre de Certificado</label>
    <div class="input-group">
        <input class="form-control" type="text" id="NombreCer" name="NombreCer" value="{{ isset($cerregistro->maecertificado_id) ?  $nombreCer->first()->Nombre_Certificado : ''}}" readonly required>
        <span class="input-group-btn">
            <button class="btn btn-default" id="button" type="button" title="Seleccionar Certificado" data-toggle="modal" data-target="#certificadosModal" {{ $formMode === 'edit' ? 'disabled' : '' }}><i class="fa fa-file-text"></i></button>
        </span>
    </div>
    </div>

    <div class="form-group {{ $errors->has('fecha_Expedicion') ? 'has-error' : ''}} col-md-7 mb-3">
        <label for="fecha_Expedicion" class="control-label">{{ 'Fecha Expedicion' }}</label>
        <input class="form-control" name="fecha_Expedicion" type="date" max="<?php echo date("Y-m-d");?>" id="fecha_Expedicion" value="{{ isset($cerregistro->fecha_Expedicion) ? $cerregistro->fecha_Expedicion : ''}}">
        {!! $errors->first('fecha_Expedicion', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="div col-md-1"></div>
    <div class="form-group {{ $errors->has('tipo_id') ? 'has-error' : ''}} col-md-4">
        <label for="tipo_id">Tipo de certificación</label>
        <select class="form-control" id="tipo_id" name="tipo_id" required >
            <option value="">Seleccione el Tipo de certificacion</option>
           @foreach ($mae_tipo_cer as $item)
        <option value="{{$item->id}}" {{(isset($cerregistro->tipo_id)&&$cerregistro->tipo_id==$item->id)?'selected':''}}>{{$item->nombre_tipo_cer}}</option>
          @endforeach
        </select>
    </div>

    <div class="div col-md-1"></div>
    <div class="form-group {{ $errors->has('archivo') ? 'has-error' : ''}} col-md-7">
        <label for="archivo"  class="control-label">{{ 'Constancia de certificado' }}{{isset($cerregistro->archivo) ? ': '.$cerregistro->archivo : ''}}</label>
        <input class="form-control" accept="application/pdf" name="archivo" type="file" id="archivo">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1"></div>
    <div class="form-group {{ $errors->has('nivel_id') ? 'has-error' : ''}}col-md-4 mb-3">
        <label for="nivel_id">Nivel de la certificación</label>
        <select class="form-control" id="nivel_id" name="nivel_id" required >
            <option value="">Seleccione el nivel de la certificación</option>
           @foreach ($mae_nivel_cer as $item)
        <option value="{{$item->id}}" {{(isset($cerregistro->nivel_id)&&$cerregistro->nivel_id==$item->id)?'selected':''}}>{{$item->nombre_nivel_cer}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group {{ $errors->has('fecha_exp_concepto') ? 'has-error' : ''}} col-md-7 mb-3">
        <label for="fecha_exp_concepto" class="control-label">{{ 'Fecha Expedicion del concepto aptitud' }}</label>
        <input class="form-control" name="fecha_exp_concepto" type="date" max="<?php echo date("Y-m-d");?>" id="fecha_exp_concepto" value="{{ isset($cerregistro->fecha_exp_concepto) ? $cerregistro->fecha_exp_concepto : ''}}"
        >
        {!! $errors->first('fecha_exp_concepto', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1"></div>

    <div class="form-group {{ $errors->has('concepto_aptitud') ? 'has-error' : ''}} col-md-4 mb-3">
        <label for="concepto_aptitud" class="control-label">{{ 'Concepto de Aptitud' }}</label>
        <div class="radio">
            <label><input name="concepto_aptitud" id="Apto" type="radio" value="1" {{ (isset($cerregistro) && 1 == $cerregistro->concepto_aptitud) ? 'checked' : '' }}>Apto</label>
        </div>
        <div class="radio">
            <label><input name="concepto_aptitud" id="NoApto" type="radio" value="0" @if (isset($cerregistro)) {{ (0 == $cerregistro->concepto_aptitud) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No Apto</label>
        </div>
            {!! $errors->first('concepto_aptitud', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('observacion') ? 'has-error' : ''}} col-md-7">
        <label for="observacion"  class="control-label">{{ 'Observación' }}</label>
        <textarea class="form-control" name="observacion" rows="5" cols="66" id="observacion" maxlength="300">{{ isset($cerregistro->observacion) ? $cerregistro->observacion : ''}}</textarea>
        {!! $errors->first('observacion', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1"></div>
    <div class="form-group {{ $errors->has('maeentecertificador_id') ? 'has-error' : ''}} col-md-4 mb-3">
        <label for="maeentecertificador_id">Ente certificador</label>
        <select class="form-control custom-select" id="maeentecertificador_id" name="maeentecertificador_id" size="5" multiple>
        <option value="">Seleccione un ente certificador</option>
           @foreach ($entecertificado->sortBy('Nombre_EnteCertificador') as $item)
        <option value="{{$item->id}}" {{(isset($cerregistro->maeentecertificador_id)&&$cerregistro->maeentecertificador_id==$item->id)?'selected':''}}>{{$loop->iteration.'|'.$item->Nombre_EnteCertificador}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group {{ $errors->has('archivo_concepto') ? 'has-error' : ''}} col-md-7">
        <label for="archivo"  class="control-label">{{ 'Constancia Concepto de Aptitud' }}{{isset($cerregistro->archivo_concepto) ? ': '.$cerregistro->archivo_concepto : ''}}</label>
        <input class="form-control" accept="application/pdf" name="archivo_concepto" type="file" id="archivo_concepto">
        {!! $errors->first('archivo_concepto', '<p class="help-block">:message</p>') !!}
    </div>

</div>
    <div class="row col-md-offset-7" >
    <input type="hidden" name="Num_Sap" id="Num_Sap" value="{{(isset($cerregistro->Num_Sap)? $cerregistro->Num_Sap:'')}}">
    <input type="hidden" name="maecertificado_id" id="maecertificado_id" value="{{(isset($cerregistro->maecertificado_id)? $cerregistro->maecertificado_id:'')}}">
        {{-- <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Agregar' }}"> --}}
        @if ($formMode === 'edit')
             <button class="btn" id="button"type="submit" title="Guardar Cambios" onclick="return confirm(&quot;Presione el boton aceptar para guardar los cambios realizados.&quot;)">
            <img src="{{asset("assets/$theme/dist/img/save_as_100px.png")}}" id="button-action" class="rounded float-left img-fluid" alt="..."
             width="80px"; style="margin-left:50%;"></button>
        @else
        <button class="btn" id="button" type="submit" title="Guardar Nuevo registro"  onclick="return confirm(&quot;Presione el boton aceptar para guardar el nuevo registro.&quot;)">
            <img src="{{asset("assets/$theme/dist/img/save_close_100px.png")}}" id="button-action" class=" rounded float-left img-fluid" alt="..."
             width="80px"; style="margin-right:2%;" >
        </button>
        @endif
    </div>
</div>
