@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="col-md-12">
    <legend><strong> Editar paso para proceso de titulación</strong></legend>
</div>
<br>
<form action="{{ route('procesotitulacion.update', $procesotitulacion->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT')}}

    <div class="col-md-4">
        <label for="opcion" class="control-label">Opción de titulación</label>
        <select id="opcion" name="opcion" class="form-control" required="">
            <option value="opcion">Seleccione Opción de titulación</option>
            @foreach($opcion as $op)
            <option value="{!! $op->id !!}" {{(old('opcion',$procesotitulacion->id_opcion)==$op->id)? 'selected':''}}>{!! $op->nombre_opcion !!}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="control-label" for="orden">Paso número:</label>
        <input class="form-control" type="text" id="orden" name="orden" value="{{ old('orden', $procesotitulacion->orden) }}" required>
    </div>

    <div class="col-md-4">
        <label class="control-label" for="descripcion">Descripción del paso:</label>
        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $procesotitulacion->descripcion) }}">
    </div>

    <p class="col-md-12 form-group">
        <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
        <button data-toggle="modal" data-target="#modal1" class="btn btn-raised btn-primary">Cancelar</button>
    </p>

<!-- Modal Structure -->
    <div class="modal" id="modal1" name="modal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>¿Seguro de que desea cancelar?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('procesotitulacion.index') }}" class="btn btn-raised btn-primary">Aceptar</a>
                    <a href="{{ url()->current() }}" class="btn btn-raised btn-primary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endif
@endsection
