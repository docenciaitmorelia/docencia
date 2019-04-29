@extends('layouts.app')

@section('content')
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

    <p class="col-md-12 form-group">
        <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
        <button name="cancel" id="cancel" data-toggle="modal" data-target="#modal1" class="btn btn-raised btn-primary" required>Cancelar</button>
    </p>



  <!-- Modal Structure -->
  <div class="modal" id="modal1" name="modal1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>¿Seguro de que desea cancelar?</p>
        </div>
        <div class="modal-footer">
          <a href="{{ route('catalogoac.index') }}" class="btn btn-raised btn-primary">Aceptar</a>
          <a href="{{ url()->current() }}" class="btn btn-raised btn-primary">Cancelar</a>
        </div>
      </div>
    </div>
  </div>

</form>
</div>
</div>
</div>
</div>
@endsection
