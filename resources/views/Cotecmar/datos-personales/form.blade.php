<div class="form-group {{ $errors->has('Num_Sap') ? 'has-error' : ''}}">
    <label for="Num_Sap" class="control-label">{{ 'Num Sap' }}</label>
    <input class="form-control" name="Num_Sap" minlength="8" type="text" id="Num_Sap" maxlength="8" min="0" value="{{ isset($datospersonale->Num_Sap) ? $datospersonale->Num_Sap : ''}}" >
    {!! $errors->first('Num_Sap', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Identificacion') ? 'has-error' : ''}}">
    <label for="Identificacion" class="control-label">{{ 'Identificacion' }}</label>
    <input class="form-control" name="Identificacion" type="text" id="Identificacion" value="{{ isset($datospersonale->Identificacion) ? $datospersonale->Identificacion : ''}}" >
    {!! $errors->first('Identificacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('Apellidos_Nombres') ? 'has-error' : ''}}">
    <label for="Apellidos_Nombres" class="control-label">{{ 'Apellidos Nombres' }}</label>
    <input class="form-control" name="Apellidos_Nombres" type="text" id="Apellidos_Nombres" value="{{ isset($datospersonale->Apellidos_Nombres) ? $datospersonale->Apellidos_Nombres : ''}}" >
    {!! $errors->first('Apellidos_Nombres', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
