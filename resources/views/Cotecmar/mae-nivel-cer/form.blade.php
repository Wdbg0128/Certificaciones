
<div class="form-group {{ $errors->has('nombre_nivel_cer') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="nombre_nivel_cer" class="control-label">{{ 'Nombre Certificado' }}</label>
    <input class="form-control" name="nombre_nivel_cer" type="text" id="nombre_nivel_cer" value="{{ isset($nivelCer->nombre_nivel_cer) ? $nivelCer->nombre_nivel_cer : ''}}" >
    {!! $errors->first('nombre_nivel_cer', '<p class="help-block">:message</p>') !!}
</div>

{{-- @if (($formMode === 'create'))
<input class="hidden" name="Estado" value="1">
@else
<div class="form-group {{ $errors->has('Estado') ? 'has-error' : ''}} col-md-5 mb-3">
    <label for="Estado" class="control-label">{{ 'Estado' }}</label>
    <div class="radio">
    <label><input name="Estado" type="radio" value="1" {{ (isset($nivelCer) && 1 == $nivelCer->Estado) ? 'checked' : '' }}>Activo</label>
    </div>
    <div class="radio">
        <label><input name="Estado" type="radio" value="0" @if (isset($nivelCer)) {{ (0 == $nivelCer->Estado) ? 'checked' : '' }} @else {{ 'checked' }} @endif>Inactivo</label>
    </div>
        {!! $errors->first('Estado', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-2"></div>
@endif --}}
<div class="form-group row">
    <input class="btn btn-primary" style="width:80px" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Crear' }}">
</div>
