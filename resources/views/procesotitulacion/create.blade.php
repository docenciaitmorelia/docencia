@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Registrar los pasos de cada Opción de Titulación</h3>
        @include('procesotitulacion.fragment.error')
        <form action="{{ route('procesotitulacion.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-4">
          		<label for="opcion" class="control-label">Opción de titulación</label>
          		<select id="opcion" name="opcion" class="form-control">
          			<option value="">Seleccione Opción de titulación</option>
          			@foreach($opcion as $op)
          				<option value="{!! $op->id !!}">{!! $op->nombre_opcion !!}</option>
          			@endforeach
          		</select>
        	  </div>

          <div class="col-md-4">
              <label class="control-label" for="orden">Paso número:</label>
              <input maxlength="10" class="form-control" type="text" id="orden" name="orden" style="text-transform:uppercase;">
          </div>

          <div class="col-md-4">
              <label class="control-label" for="descripcion">Descripción del paso:</label>
              <input maxlength="255" class="form-control" type="text" id="descripcion" name="descripcion">
          </div>

          <p class="col-md-12 form-group">
              <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
              <a name="cancel" id="cancel" data-toggle="modal" data-target="#modal1" href="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
          </p>
        </form>

        <!-- Modal Structure -->
        <div id="modal1" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('procesotitulacion.index') }}" method="POST" id='form-modal1'>
                    {{ csrf_field() }}
                </form>
                <p>¿Seguro de que desea cancelar?</p>
              </div>
              <div class="modal-footer">
                <a href="{{ route('procesotitulacion.index') }}" type="button" class="btn btn-primary" >Aceptar</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
