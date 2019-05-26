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
            <input type="hidden" name="_token" value="{{ csrf_token() }}" required>
            <div class="col-md-12">
          		<label for="opcion" class="control-label">Opción de titulación</label>
          		<select id="opcion" name="opcion" class="form-control">
          			<option value="">Seleccione Opción de titulación</option>
          			@foreach($opciones as $op)
          				<option value="{!! $op->id !!}">
                    {{$op->opcion_titulacion}}. {{ $op->nombre_opcion }}(
                      @foreach($reticulas as $ret)
                        @if($ret->id_opcion_titulacion == $op->id)
                          {{$ret->reticula}}
                        @endif
                      @endforeach
                    )
                  </option>
          			@endforeach
          		</select>
        	  </div>

          <div class="col-md-6">
              <label class="control-label" for="orden">Paso número:</label>
              <input maxlength="10" class="form-control" type="number" id="orden" name="orden" style="text-transform:uppercase;" required>
          </div>

          <div class="col-md-6">
              <label class="control-label" for="descripcion">Descripción del paso:</label>
              <select id="descripcion" name="descripcion" class="form-control" required>
                <option value="" selected>Seleccione Opción de titulación</option>
                  <option value="Asignación de tema y asesor">Asignación de tema y asesor</option>
                  <option value="Asignación de Sinodales">Asignación de Sinodales</option>
                  <option value="Impresión Definitiva">Impresión Definitiva</option>
                  <option value="Asignación de Revisores">Asignación de Revisores</option>
                  <option value="Liberación de Proyecto">Liberación de Proyecto</option>
                  <option value="Invitación a Ceremonia de Titulación">Invitación a Ceremonia de Titulación</option>
              </select>
            </div>

            <p class="form-group col-md-12">
              <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
              <a data-toggle="modal" data-target="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
            </p>


            <!-- Modal Structure -->
            <div id="modal1" class="modal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Eliminar</h3>
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
                    <a href="{{ route('titulaciones.index') }}" type="button" class="btn btn-primary" >Aceptar</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div> <!-- end modal structure -->
        </form>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
