<div class="form-group {{ $errors->has('Nombre_EnteCertificador') ? 'has-error' : ''}}">
    <label for="Nombre_EnteCertificador" class="control-label">{{ 'Nombre Entecertificador' }}</label>
    <input class="form-control" name="Nombre_EnteCertificador" type="text" id="Nombre_EnteCertificador" value="{{ isset($maeentecertificador->Nombre_EnteCertificador) ? $maeentecertificador->Nombre_EnteCertificador : ''}}" >
    {!! $errors->first('Nombre_EnteCertificador', '<p class="help-block">:message</p>') !!}
</div>
@if ($formMode === 'edit')
<div class="form-group {{ $errors->has('Estado') ? 'has-error' : ''}}">
    <label for="Estado" class="control-label">{{ 'Estado' }}</label>
    <div class="radio">
        <label><input name="Estado" type="radio" value="1" {{ (isset($maeentecertificador) && 1 == $maeentecertificador->Estado) ? 'checked' : '' }}> Activar</label>
    </div>
    <div class="radio">
        <label><input name="Estado" type="radio" value="0" @if (isset($maeentecertificador)) {{ (0 == $maeentecertificador->Estado) ? 'checked' : '' }} @else {{ 'checked' }} @endif>Desactivar</label>
    </div>
    {!! $errors->first('Estado', '<p class="help-block">:message</p>') !!}
</div>
@else
<div class="form-group {{ $errors->has('Estado') ? 'has-error' : ''}}">
    <input class="hidden" name="Estado" id="Estado" value="1" >
</div>
@endif

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Crear' }}">
</div>
