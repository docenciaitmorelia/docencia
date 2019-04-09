@extends('layouts.app')

@section('content')
@foreach($alumno as $al)
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title"> <center>Registro de Proyecto de Titulación</center></h3>
				<center>
				<div class="col-md-12">
				<br>
				<h4> <b>{{$al->no_de_control}} — {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</b></h4>
				</div>
				</center>
				@endforeach
				@foreach($titulacion as $titu)
				<hr>
				<center><h5><i>{{$titu->nombre_opcion}}</i></h5></center>

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
								<td><input type="t_asesor" name="t_asesor" class="form-control" placeholder="DR."></td><td> {{ $titu->asesor }}</td>

								<td><input type="t_presidente" name="t_presidente" class="form-control" placeholder="DR."></td><td>{{ $titu->presidente }}
								</td>

								<td><input type="t_secretario" name="t_secretario" class="form-control" placeholder="DR."></td><td>{{ $titu->secretario }}
								</td>

								<td><input type="t_vocalp" name="t_vocalp" class="form-control" placeholder="DR."></td><td>{{ $titu->vocal_propietario }}
								</td>

								 <td><input type="t_volcals" name="t_volcals" class="form-control" placeholder="DR."></td><td>{{ $titu->vocal_suplente }}
								</td>
							</tr>
					</tbody>
				</table>
					<br>
				@endforeach
					<form action="{{ route('crear_registro', $al->no_de_control)}}" method="POST" target="_blank">
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
