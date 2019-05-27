@extends('layouts.app')

@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Registrar catalogo de actividades</h3>

@include('catalogoac.fragment.error')

<form action="{{ route('catalogoac.store') }}" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="col-md-6">
        <label class="control-label" for="actividad">Nombre de la actividad</label>
        <input class="form-control" type="text" id="actividad" name="actividad" style="text-transform:uppercase;" required>
    </div>

    <div class="col-md-6">
        <label class="control-label" for="creditos">Número de créditos</label>
        <input class="form-control" type="number" id="creditos" name="creditos" required>
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
