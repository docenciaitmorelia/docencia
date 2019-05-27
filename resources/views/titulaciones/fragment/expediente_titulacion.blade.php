@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
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
				<center><h5><i>{{$titulacion->nombre_opcion}}<br>Estatus de proceso de Titulación: {{$titulacion->estatus}}</i></h5>
					@if($titulacion->detalle_opcion == 'Recepcional')
					<a href="{{ route('control_p', $titulacion->id) }}" class="btn btn-raised btn-primary" data-toggle="tooltip" title="Control de Propuesta" target="_blank"><i class="material-icons">playlist_add_check</i></a>
					<a href="{{ route('control_b', $titulacion->id) }}" class="btn btn-raised btn-primary" data-toggle="tooltip" title="Control de borrador" target="_blank"><i class="material-icons">playlist_add_check</i></a>
					@endif
				</center>

					<table class="table table-striped table-hover">
						<thead>
							<tr>
								@if($ae->asesor_externo == 'N')
								<th><center>Asesor</center></th>
								<th colspan="3"><center>Revisores</center></th>
								<th colspan="1"></th>
								@else
								<th><center>Asesor</center></th>
								<th colspan="3"><center>Revisores</center></th>
								<th colspan="1"></th>
								@endif
							</tr>
						</thead>
						<tbody>
								<tr>
									@if($ae->asesor_externo == 'N')
									<td>
										{{$titulacion->asesor}}
									</td>
									@else
									<td>
										{{$titulacion->asesor_externo}}
									</td>
									@endif
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
										<a href="{{ route('titulaciones.edit', $titulacion->id) }}" class="btn btn-raised btn-primary" data-toggle="tooltip" title="Editar Expediente"><i class="material-icons">create</i></a>
										@if($titulacion->detalle_opcion == 'Recepcional' && $titulacion->estatus == 'ACTIVO')
										<a href="{{route('showRevisiones',$titulacion->alumno) }}" data-target="titulacion" class="btn btn-raised btn-primary" data-toggle="tooltip" title="Ver Status de Revisiones"><i class="material-icons">find_in_page</i></a>
										@endif
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
				    @foreach($proceso as $p)
				        <input type="checkbox" name="proceso" value="{{$p->orden}}" @if($orden >= $p->orden) checked='' disabled=''> <p class="label label-success">{{$p->descripcion}} @else disabled=''> <p class="label label-default">{{$p->descripcion}}@endif</p><br>
				    @endforeach
						@endif
				    </div>
				    <div class="col-md-6">
				    @if($titulacion->estatus=='ACTIVO' || $titulacion->estatus =='TITULADO' )
						@if($titulacion->detalle_opcion == 'Recepcional')
					<form action="{{ route('gen_documentos', $titulacion->id) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-12">
							<label for="documento" class="control-label">Tipo de Documento</label>
							<select id="documento" type="text" class="form-control" name="documento" value="" required autofocus>
								<option value="">Seleccione documento</option>
									@foreach($proceso as $documento)
										<option id="documento" value="{{ $documento->descripcion }}" >{{$documento->descripcion}}</option>
									@endforeach
						  </select>
						</div>
						@else
						<form action="{{ route('gen_documentos', $titulacion->id) }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-md-12">
								<label for="documento" class="control-label">Tipo de Documento</label>
								<select id="documento" type="text" class="form-control" name="documento" value="" required>
									<option value="">Seleccione documento</option>
										@foreach($proceso as $documento)
											<option id="documento" value="{{ $documento->descripcion }}">{{$documento->descripcion}}</option>
										@endforeach
							  </select>
							</div>
						@endif
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
@endif
@endsection
