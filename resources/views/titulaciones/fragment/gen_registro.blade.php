@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title"> <center>Registro de Proyecto de Titulación</center></h3>
				<center>
				<div class="col-md-12">
				<br>
				<h4> <b>{{$alumno->no_de_control}} — {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</b></h4>
				</div>
				</center>
				<hr>
				<center><h5><i>{{$titulacion->nombre_opcion}}</i></h5></center>

				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th colspan="2"><center>Asesor</center></th>
							<th colspan="2"> <center>Presidente</center></th>
							<th colspan="2"> <center>Secretario</center></th>
							<th colspan="2"> <center>Vocal Propietario</center></th>
							<th colspan="2"> <center>Vocal Suplente</center></th>
							<th colspan="1"></th>
						</tr>
					</thead>
					<tbody>

							<tr>
								<td>{{$titulacion->estudios_asesor}}</td><td> {{ $titulacion->asesor }}</td>

								<td>{{$titulacion->estudios_presidente}}</td><td>{{ $titulacion->presidente }}
								</td>

								<td>{{$titulacion->estudios_secretario}}</td><td>{{ $titulacion->secretario }}
								</td>

								<td>{{$titulacion->estudios_vocal_propietario}}</td><td>{{ $titulacion->vocal_propietario }}
								</td>

								 <td>{{$titulacion->estudios_vocal_suplente}}</td><td>{{ $titulacion->vocal_suplente }}
								</td>
							</tr>
					</tbody>
				</table>
					<br>
					<form action="{{ route('crear_registro', $alumno->no_de_control)}}" method="POST" target="_blank">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<p class="col-md-12">
							<button type="submit" class="btn btn-raised btn-primary">Generar PDF</button>
							<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
