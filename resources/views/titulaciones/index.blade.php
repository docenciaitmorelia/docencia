@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="{{ route('titulaciones.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
				<form action="" method="GET" class="form-horizontal">
					<div class="col-md-6 form-group">
						<input type="text" id="busqueda" name="busqueda" style="text-transform:uppercase;" placeholder="Buscar..." class="form-control">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
					</div>
				</form>

				<div class="col-md-12">
					<h3>Titulaciones</h3>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Numero de Control</th>
								<th>Paterno</th>
								<th>Materno</th>
								<th>Nombre</th>
				                <th>Estatus Titulación</th>
								<th colspan="1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alumnos as $alumno)
								<tr>
									<td>{{ $alumno->no_de_control }}</td>
									<td>
										<strong>{{ $alumno->apellido_paterno }}</strong>
									</td>
									<td>
										<strong>{{ $alumno->apellido_materno }}</strong>
									</td>
									<td>
										<strong>{{ $alumno->nombre_alumno }}</strong>
									</td>
				                    <td>
				                        {{ $alumno->estatus }}
				                    </td>
									<td>
										<a href="{{route('detalles_titu',[$alumno->no_de_control, $alumno->estatus]) }}" data-target="titulacion" class="btn btn-raised btn-primary">Expediente</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $alumnos->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endif


@endsection
