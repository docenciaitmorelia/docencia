	@csrf
	<div class="form-group col-md-6">
			<label for="alumno" class="bmd-label-floating col-form-label">{{ __('Alumno') }}</label>
					<select id="alumno" type="text" class="form-control{{ $errors->has('alumno') ? ' is-invalid' : '' }}" name="alumno" value="" required>
						@foreach($alumnos as $alumno)
							<option id="alumno" value="{{ $alumno->no_de_control }}">{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</option>
						@endforeach
					</select>
					@if ($errors->has('alumno'))
							<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('alumno') }}</strong>
							</span>
					@endif
					<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">search</i></a>
	</div>

	<div class="col-md-4">
		<label for="plan" class="control-label">Plan de estudios</label>
		<select id="plan" name="plan" class="form-control">
			<option value="">Seleccione Plan de estudios</option>
			@foreach($plan as $p)
			<option value="{!! $p->plan_de_estudios!!}">{!! $p->plan_de_estudios !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="opc_titu" class="control-label">Opción de titulación</label>
		<select id="opc_titu" name="opc_titu" class="form-control">
			<option value="">Seleccione Opción de titulación</option>
			@foreach($opcion as $op)
				<option value="{!! $op->id !!}">{!! $op->nombre_opcion !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="proyecto" class="control-label">Nombre del proyecto</label>
		<input type="text" id="proyecto" name="proyecto" class="form-control" style="text-transform:uppercase;">
	</div>
	<br>
	<hr>
	<br>
	<div class="col-md-12">
		<label for="asesor" class="control-label">Asesor</label>
		<select id="asesor" name="asesor" class="form-control">
			<option value="">Seleccione Asesor</option>
			@foreach($personal as $doc)
			<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="presidente" class="control-label">Presidente</label>
		<select id="presidente" name="presidente" class="form-control">
			<option value="">Seleccione Presidente</option>
			@foreach($personal as $doc)
			<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="secretario" class="control-label">Secretario</label>
		<select id="secretario" name="secretario" class="form-control">
			<option value="">Seleccione Secretario</option>
			@foreach($personal as $doc)
			<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="vocal_propietario" class="control-label">Vocal Propietario</label>
		<select id="vocal_propietario" name="vocal_propietario" class="form-control">
			<option value="">Seleccione Vocal Propietario</option>
			@foreach($personal as $doc)
			<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
			@endforeach
		</select>
	</div>

    <div class="col-md-4">
		<label for="vocal_suplente" class="control-label">Vocal Suplente</label>
		<select id="vocal_suplente" name="vocal_suplente" class="form-control">
			<option value="">Seleccione Vocal Suplente</option>
			@foreach($personal as $doc)
			<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
			@endforeach
		</select>
	</div>

	<div class="col-md-4">
		<input type="checkbox" id="aec" name="aec" value="AE">Asesor Externo
	</div>

	<div class="col-md-4" style="display: none;" id="aediv" name="aediv">
		<label for="ae" class="control-label">Nombre del Asesor</label>
		<input type="text" id="ae" name="ae" class="form-control" value="" style="text-transform:uppercase;">
	</div>

	<p class="col-md-12">
		<button type="submit" class="btn btn-raised btn-primary">Guardar</button>
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

	<script type="text/javascript">
		$('#aec').on('click', function(){
		if ( $(this).prop('checked') ) {
		    $('#aediv').show();
		}
		else {
		    $('#aediv').hide();
		}
		});
	</script>
