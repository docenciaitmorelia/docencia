@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div class="col-md-12">
					<h3> Editar actividad</h3>
		<br>
		<br>
		<br>
		<form action="{{ route('catalogoac.update', $catalogoac->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT')}}
			<div class="col-md-6 form-group">
				<label class="control-label" for="nombre">Nombre de la actividad</label>
				<input class="form-control" type="text" id="actividad" name="actividad" value="{{ old('actividad', $catalogoac->actividad) }}" style="text-transform:uppercase;">
			</div>

			<div class="col-md-6 form-group">
			    <label class="control-label" for="creditos">Número de créditos</label>
			    <input class="form-control" type="number" id="creditos" name="creditos" value="{{ old('creditos', $catalogoac->creditos) }}">
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
