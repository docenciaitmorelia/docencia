@extends('layouts.app')

@section('content')
@foreach($alumno as $al)
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title"> <center>Impresión Definitiva</center></h3>
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
				<form action="../crear_impresion_d/{{$al->no_de_control}}" method="POST" target="_blank">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
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

								 <td><input type="t_vocals" name="t_vocals" class="form-control" placeholder="DR."></td><td>{{ $titu->vocal_suplente }}
								</td>
							</tr>
					</tbody>
				</table>
					<br>
				@endforeach

						<div class="col-md-12">
					<div class="col-md-4">
						<label for="oficio" class="control-label">Oficio</label>
						<input type="text" id="oficio" name="oficio" class="form-control" placeholder="DSC-D-001/2018" required>
					</div>
						<div class="col-md-4">
							<label for="depto" class="control-label">Departamento</label>
							<input type="text" id="depto" name="depto" class="form-control" placeholder="DEPARTAMENTO DE..." style="text-transform:uppercase;" required>
						</div>
							<div class="col-md-4">
								<label for="seccion" class="control-label">Sección</label>
								<input type="text" id="seccion" name="seccion" class="form-control" placeholder="SISTEMAS Y COMPUTACIÓN" style="text-transform:uppercase;" required>
							</div>
							</div>

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
