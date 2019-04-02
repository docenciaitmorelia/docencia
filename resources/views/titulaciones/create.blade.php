@extends('layouts.app')
@section('content')
<span class="card-title">Registrar Titulación</span>

@include('titulaciones.fragment.error')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Filtrar Alumnos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="modalform1" action="" method="GET" class="form-horizontal">
					<div class="col-md-6 form-group">
						<input type="text" id="busqueda" name="busqueda" style="text-transform:uppercase;" placeholder="Nombre o número de control..." class="form-control">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
					</div>
				</form>
				<table style="width:100%">
				<tr>
					<th>No. Control</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombre(s)</th>
					<th>Carrera</th>
				</tr>
				@foreach($alumnos as $alumno)
				<tr>
					<td>{{$alumno->no_de_control}}</td>
					<td>{{$alumno->apellido_paterno}}</td>
					<td>{{$alumno->apellido_materno}}</td>
					<td>{{$alumno->nombre_alumno}}</td>
					<td>{{$alumno->carrera}}</td>
				</tr>
				@endforeach
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Aceptar</button>
			</div>
		</div>
	</div>
</div>
<form action="{{ route('titulaciones.store') }}" method="POST" class="form">
	@include('titulaciones.fragment.form')
</form>

@endsection
