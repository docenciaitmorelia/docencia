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
							<td>{{$alumno->reticula}}-{{$alumno->nombre_reducido}}</td>
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
					<form id="formTitulacion" action="{{ route('titulaciones.store') }}" method="POST" class="form">
						@csrf
						<div class="form-group col-md-6">
								<label for="alumno" class="bmd-label-floating col-form-label">{{ __('Alumno') }}</label>
										<select id="alumno" type="text" class="form-control{{ $errors->has('alumno') ? ' is-invalid' : '' }}" name="alumno" value="" required autofocus>
											@foreach($alumnos as $alumno)
												<option id="alumno" value="{{ $alumno->no_de_control }}">{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</option>
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


						<div class="form-group col-md-5">
							<label for="opc_titu" class="control-label">Opción de titulación</label>
							<select id="opc_titu" name="opc_titu" class="form-control" required>
								<option value="">Seleccione Opción de titulación</option>
								@foreach($planes as $op)
									<option value="{!! $op->id !!}">{!! $op->reticula !!} {!! $op->opcion_titulacion !!} {!! $op->nombre_opcion !!}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-12">
							<label for="proyecto" class="control-label">Nombre del proyecto</label>
							<input type="text" id="proyecto" name="proyecto" class="form-control" style="text-transform:uppercase;" required>
						</div>
						<br>
						<hr>
						<br>
						<div class="form-group col-md-12">
							<label for="asesor" class="control-label">Asesor</label>
							<select id="asesor" name="asesor" class="form-control" required>
								<option value="">Seleccione Asesor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="presidente" class="control-label">Presidente</label>
							<select id="presidente" name="presidente" class="form-control" required>
								<option value="">Seleccione Presidente</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="secretario" class="control-label">Secretario</label>
							<select id="secretario" name="secretario" class="form-control" required>
								<option value="">Seleccione Secretario</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="vocal_propietario" class="control-label">Vocal Propietario</label>
							<select id="vocal_propietario" name="vocal_propietario" class="form-control" required>
								<option value="">Seleccione Vocal Propietario</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
								@endforeach
							</select>
						</div>

					    <div class="form-group col-md-6">
							<label for="vocal_suplente" class="control-label">Vocal Suplente</label>
							<select id="vocal_suplente" name="vocal_suplente" class="form-control" required>
								<option value="">Seleccione Vocal Suplente</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<input type="checkbox" id="aec" name="aec" value="AE">Asesor Externo
						</div>

						<div class="form-group col-md-6" style="display: none;" id="aediv" name="aediv">
							<label for="ae" class="control-label">Nombre del Asesor</label>
							<input type="text" id="ae" name="ae" class="form-control" value="" style="text-transform:uppercase;" required>
						</div>

						<p class="form-group col-md-12">
							<button type="submit" class="btn btn-raised btn-primary" onclick="validarFormulario()">Guardar</button>
							<a data-toggle="modal" data-target="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
						</p>



					  <!-- Modal Structure -->
						<div class="modal" id="modal1" name="modal1">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-body">
						        <p>¿Seguro de que desea cancelar?</p>
						      </div>
						      <div class="modal-footer">
						        <a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Aceptar</a>
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

<script type="text/javascript">
	$('#aec').on('click', function(){
	if ( $(this).prop('checked') ) {
			$('#aediv').show();
	}
	else {
			$('#aediv').hide();
	}
	});

	function validarFormulario(){
		 $("#formTitulacion").validate();
		 var asesor = $('#asesor').val();
		 alert(asesor);
		 var presidente = $('#presidente').val();
		 if(asesor==presidente){
			 alert('son iguales');
		 }
	}
	$(document).ready(function(){
		 validarFormulario();
	});

</script>

@endif
@endsection
