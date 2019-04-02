@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')


@include('titulaciones.fragment.error')
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
				<form id="modalform1" action="" method="GET" class="form-horizontal">
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
							<td>{{$alumno->carrera}}</td>
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
		    <h3 class="card-title">Registrar Titulación</h3>
					<form action="{{ route('titulaciones.store') }}" method="POST" class="form">
						@include('titulaciones.fragment.form')
					</form>
		  </div>
		</div>
	</div>
</div>

@endif
@endsection
