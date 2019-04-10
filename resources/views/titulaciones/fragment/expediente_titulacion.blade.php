@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title">Expediente de proceso de titulación</h3>

				<center>
				<div class="col-md-12">
					<h3> <b>{{$alumno->no_de_control}} — {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</b></h3>
				</div>
				</center>
				<hr>
				<center><h5><i>{{$titulacion->nombre_opcion}}<br>Estatus de proceso de Titulación: {{$estatus}}</i></h5></center>

					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><center>Asesor</center></th>
								<th><center>Presidente</center></th>
								<th><center>Secretario</center></th>
								<th><center>Vocal Propietario</center></th>
								<th><center>Vocal Suplente</center></th>
								<th colspan="1"></th>
							</tr>
						</thead>
						<tbody>

								<tr>
									<td>{{ $titulacion->asesor }}</td>

									<td>
										{{ $titulacion->presidente }}
									</td>

									<td>
										{{ $titulacion->secretario }}
									</td>

									<td>
										{{ $titulacion->vocal_propietario}}
									</td>

				                    <td>
										{{ $titulacion->vocal_suplente}}
									</td>

									<td>
										<a href="{{ route('titulaciones.edit', $titulacion->id) }}" class="btn btn-raised btn-primary"><i class="material-icons">create</i></a>
									</td>
								</tr>
						</tbody>
					</table>
					<br>
				    <div class="col-md-6">
				    <p>Proceso de titulación: </p>
						@if($orden=='Alta')
							<p>
								No hay documentos generados
							</p>
						@else
				        <input type="checkbox" name="proceso" value="{{$proceso->orden}}"
								@if($orden >= $proceso->orden)
								 checked='' disabled=''>
								 <p class="label label-success">
							  @else
								 disabled=''>
								 <p class="label label-default">
								@endif
							  {{$proceso->descripcion}}</p><br>
						@endif
				    </div>
				    <div class="col-md-6">
				    @if($estatus=='ACTIVO')
					<form action="{{ route('gen_documentos', $alumno->no_de_control) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-12">
							<label for="documento" class="control-label">Tipo de Documento</label>
							<select id="documento" type="text" class="form-control" name="documento" value="" required autofocus>
								<option value="">Seleccione documento</option>
									@foreach($proceso as $documento)
										<option id="documento" value="{{ $documento->descripcion }}">{{$documento->descripcion}}</option>
									@endforeach
						  </select>
						</div>
						<p class="col-md-12">
							<button type="submit" class="btn btn-raised btn-primary">Generar Documento</button>
							<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
						</p>
					</form>
				    </div>
				@else
				    <p class="col-md-12">
							<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
						</p>
				</div>
			</div>
		</div>
	</div>
@endif
@endsection
