@extends('layouts.app')
@section('content')

@if(Auth::user()->rol == 'Jefe de Docencia')
@include('titulaciones.fragment.error')

<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title">Editar Titulación</h3>
					<form id="formTitulacion" action="{{ route('titulaciones.update', $titulacion->id) }}" method="POST" class="form">
						{{ csrf_field() }}
						{{ method_field('PUT')}}
						<div class="form-group col-md-6">
								<label for="alumno" class="bmd-label-floating col-form-label">{{ __('Alumno') }}</label>
								<input readonly type="text" id="alumno" name="alumno" class="form-control" value="{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}" style="text-transform:uppercase;">
										@if ($errors->has('alumno'))
												<span class="invalid-feedback" role="alert">
														<strong>{{ $errors->first('alumno') }}</strong>
												</span>
										@endif
						</div>
						<div class="form-group col-md-5">
							<label for="opc_titu" class="control-label">Opción de titulación</label>
							<select id="opc_titu" name="opc_titu" class="form-control" required>
								<option value="">Seleccione Opción de titulación</option>
								@foreach($planes as $op)
									<option value="{{ $op->id }}" {{(old('opc_titu',$titulacion->opc_titu)==$op->id)? 'selected':''}}>{{ $op->reticula }}/{!! $op->opcion_titulacion !!} {!! $op->nombre_opcion !!}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-12">
							<label for="proyecto" class="control-label">Nombre del proyecto</label>
							<input type="text" id="proyecto" name="proyecto" class="form-control" style="text-transform:uppercase;" value="{{ old('proyecto', $titulacion->nombre_proyecto) }}" required>
						</div>
						<br>
						<hr>
						<br>
						@if($titulacion->asesor_externo == 'N')
						<div class="form-group col-md-12">
							<label for="asesor" class="control-label">Asesor</label>
							<select id="asesor" name="asesor" class="form-control">
								<option value="">Seleccione Asesor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}" {{(old('asesor',$titulacion->asesor)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<input type="checkbox" id="aec" name="aec" onchange="myFunction()">Asesor Externo
						</div>
						<div class="form-group col-md-6" style="display: none;" id="aediv" name="aediv">
							<label for="ae" class="control-label">Nombre del Asesor externo</label>
							<input type="text" id="ae" name="ae" class="form-control" value="" style="text-transform:uppercase;" value="{{ old('ae', $titulacion->asesor_externo) }}">
						</div>
						@else
						<div class="form-group col-md-12">
							<label for="asesor" class="control-label">Asesor</label>
							<select id="asesor" name="asesor" class="form-control">
								<option value="">Seleccione Asesor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}" {{(old('asesor',$titulacion->asesor)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<input type="checkbox" id="aec" name="aec" onchange="myFunction()" checked>Asesor Externo
						</div>
						<div class="form-group col-md-6" id="aediv" name="aediv">
							<label for="ae" class="control-label">Nombre del Asesor Externo</label>
							<input type="text" id="ae" name="ae" class="form-control" style="text-transform:uppercase;" value="{{ old('ae', $titulacion->asesor_externo) }}">
						</div>
						@endif

						<div class="form-group col-md-6">
							<label for="revisor1" class="control-label">Revisor 1</label>
							<select id="revisor1" name="revisor1" class="form-control" required>
								<option value="">Seleccione Revisor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}" {{(old('revisor1',$titulacion->revisor1)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="revisor2" class="control-label">Revisor 2</label>
							<select id="revisor2" name="revisor2" class="form-control" required>
								<option value="">Seleccione Revisor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}" {{(old('revisor2',$titulacion->revisor2)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="revisor3" class="control-label">Revisor 3</label>
							<select id="revisor3" name="revisor3" class="form-control" required>
								<option value="">Seleccione Revisor</option>
								@foreach($personal as $doc)
								<option value="{!! $doc->rfc !!}" {{(old('revisor3',$titulacion->revisor3)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}, {{ $doc->rfc}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-4">
							<label for="estatus" class="control-label">Estatus</label>
							<select id="estatus" name="estatus" class="form-control" required>
								<option value="">Seleccione estatus</option>
			                    <option value="ACTIVO" {!! (old('estatus',$titulacion->estatus)=='ACTIVO')? 'selected':'' !!}>Activo</option>
			                    <option value="CANCELADO" {!! (old('estatus',$titulacion->estatus)=='CANCELADO')? 'selected':'' !!}>Cancelado</option>
							</select>
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

<script type="text/javascript">
function myFunction() {
   if($('#aec').prop('checked')) {
         $('#aediv').css('display','block');
				 $('#asesor').prop( "disabled", true );

       }
			 else {
         $('#aediv').css('display','none');
				 $('#asesor').prop( "disabled", false );
				 $('#ae').val('');
       }
		 }

</script>

@endif
@endsection
