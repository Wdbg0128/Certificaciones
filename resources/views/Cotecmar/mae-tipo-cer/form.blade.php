
<div class="form-group {{ $errors->has('nombre_tipo_cer') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="nombre_tipo_cer" class="control-label">{{ 'Nombre Certificado' }}</label>
    <input class="form-control" name="nombre_tipo_cer" type="text" id="nombre_tipo_cer" value="{{ isset($maecertificado->nombre_tipo_cer) ? $maecertificado->nombre_tipo_cer : ''}}" >
    {!! $errors->first('nombre_tipo_cer', '<p class="help-block">:message</p>') !!}
</div>
{{-- @if (($formMode === 'create'))
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
</div> --}}
<div class="col-md-2"></div>
@endif
<div class="form-group row">
    <input class="btn btn-primary" style="width:80px" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Crear' }}">
</div>
