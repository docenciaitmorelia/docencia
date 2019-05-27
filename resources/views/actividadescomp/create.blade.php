@extends('layouts.app')

@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
<div class="row">
	<div class="col">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Filtrar Alumnos</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" role="form" id="modalform1" action="#" method="GET">
					@csrf
					<div class="col-md-6 form-group">
						<input type="text" id="busqueda" name="busqueda" style="text-transform:uppercase;" placeholder="Nombre o número de control..." class="form-control">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
					</div>
				</form>
				<table style="width:100%" class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. Control</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombre(s)</th>
							<th>Carrera</th>
						</tr>
					</thead>
					<tbody>
						@foreach($alumnos as $alumno)
						<tr>
							<td>{{$alumno->no_de_control}}</td>
							<td>{{$alumno->apellido_paterno}}</td>
							<td>{{$alumno->apellido_materno}}</td>
							<td>{{$alumno->nombre_alumno}}</td>
							<td>{{$alumno->reticula}}/{{$alumno->nombre_reducido}}</td>
						</tr>
						@endforeach
					</tbody>
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Aceptar</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3><center>Registrar Actividad Complementaria</center></h3>

@include('actividadescomp.fragment.error')

<form action="{{ route('actividadescomp.store') }}" method="POST" class="form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-12">
	<div class="col-md-6">
		<label for="actividad" class="control-label">Nombre de la Actividad</label>
		<input type="text" id="actividad" name="actividad" class="form-control" style="text-transform:uppercase;" required>
	</div>

	<div class="form-group col-md-5">
			<label for="alumno" class="bmd-label-floating col-form-label">{{ __('Alumno') }}</label>
					<select id="alumno" type="text" class="form-control{{ $errors->has('alumno') ? ' is-invalid' : '' }}" name="alumno" value="" required>
						<option value="">Seleccione alumno...</option>
						@foreach($alumnos as $alumno)
							<option value="{{ $alumno->no_de_control }}">{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</option>
						@endforeach
					</select>
					@if ($errors->has('alumno'))
							<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('alumno') }}</strong>
							</span>
					@endif
	</div>
	<div class="form-group col-md-1 inline">
		<a type="button" for="alumno" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">search</i></a>
	</div>
</div>
<div class="col-md-12">
    <div class="col-md-6">
		<label for="tipo" class="control-label">Tipo de Actividad</label>
		<select id="tipo" name="tipo" class="form-control" data-live-search="true" required>
			<option value="tipo">Seleccione Tipo de actividad</option>
			@foreach($tipo as $t)
			<option value="{!! $t->id !!}">{!! $t->actividad !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-3">
		<label for="creditos" class="control-label">Número de créditos</label>
		<input type="number" id="creditos" name="creditos" max="2" class="form-control" required>
	</div>

    <div class="col-md-3">
		<label for="horas" class="control-label">Horas</label>
		<input type="number" id="horas" name="horas" class="form-control" value="0">
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-6">
		<label for="fecha_del" class="control-label">Del</label>
		<input type="text" id="fecha_del" name="fecha_del" class="form-control" style="text-transform:uppercase;" placeholder="12/02/2018" required>
	</div>

	<div class="col-md-6">
		<label for="fecha_al" class="control-label">Al</label>
		<input type="text" id="fecha_al" name="fecha_al" class="form-control" style="text-transform:uppercase;" required>
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-4">
		<label for="calificacion" class="control-label">Calificación</label>
		<input type="number" id="calificacion" name="calificacion" class="form-control" step=".01" value="0" required>
	</div>

	<div class="col-md-8">
		<label for="docente_resp" class="control-label">Docente responsable</label>
		<select id="docente_resp" name="docente_resp" class="form-control" data-live-search="true" required>
			<option value="">Seleccione docente</option>
			@foreach($docente as $doc)
			<option value="{!! $doc->rfc !!}">{{$doc->rfc}} {{ $doc->completo }}</option>
			@endforeach
		</select>
	</div>
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
</div>
@endif
@endsection
