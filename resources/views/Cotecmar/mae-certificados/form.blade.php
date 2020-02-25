
<div class="form-group {{ $errors->has('Nombre_Certificado') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="Nombre_Certificado" class="control-label">{{ 'Nombre Certificado' }}</label>
    <input class="form-control" name="Nombre_Certificado" type="text" id="Nombre_Certificado" value="{{ isset($maecertificado->Nombre_Certificado) ? $maecertificado->Nombre_Certificado : ''}}" >
    {!! $errors->first('Nombre_Certificado', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-2"></div>
<div class="form-group {{ $errors->has('Vigencia') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="Vigencia" class="control-label">{{ 'Vigencia en años' }}</label>
    <input class="form-control" name="Vigencia" type="number" id="Vigencia" value="{{ isset($maecertificado->Vigencia) ? $maecertificado->Vigencia : ''}}" required>
    {!! $errors->first('Vigencia', '<p class="help-block">:message</p>') !!}
</div>
@if (($formMode === 'create'))
<input class="hidden" name="Estado" value="1">
@else

<div class="form-group {{ $errors->has('Estado') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="Estado" class="control-label">{{ 'Estado' }}</label>
    <div class="radio">
    <label><input name="Estado" type="radio" value="1" {{ (isset($maecertificado) && 1 == $maecertificado->Estado) ? 'checked' : '' }}>Activo</label>
    </div>

    <div class="radio">
        <label><input name="Estado" type="radio" value="0" @if (isset($maecertificado)) {{ (0 == $maecertificado->Estado) ? 'checked' : '' }} @else {{ 'checked' }} @endif>Inactivo</label>
    </div>
        {!! $errors->first('Estado', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-2"></div>
@endif
<div class="form-group {{ $errors->has('concepto_aptitud') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="concepto_aptitud" class="control-label">{{ '¿Requiere Concepto de Aptitud?' }}</label>
    <div class="radio">
    <label><input name="concepto_aptitud" type="radio" value="1" {{ (isset($maecertificado) && 1 == $maecertificado->concepto_aptitud) ? 'checked' : '' }}>SI</label>
    </div>

    <div class="radio">
        <label><input name="concepto_aptitud" type="radio" value="0" @if (isset($maecertificado)) {{ (0 == $maecertificado->concepto_aptitud) ? 'checked' : '' }} @else {{ 'checked' }} @endif>NO</label>
    </div>
        {!! $errors->first('Estado', '<p class="help-block">:message</p>') !!}
</div>
@if ($formMode === 'create')
<div class="col-md-2"></div>
@endif
<div class="form-group row">
    <input class="btn btn-primary" style="width:80px" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Crear' }}">
</div>
