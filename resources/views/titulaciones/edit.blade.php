@extends('layouts.app')
@section('content')
	<div >
		<div class="input-field col s8">
			<legend><strong> Editar Titulación</strong></legend>
		</div>
		<br>
		<br>
		<form action="{{ route('titulaciones.update', $titulacion->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT')}}
			<div class="col-md-12">
				<label for="alumno" class="control-label">Alumno</label>
				<select id="alumno" name="alumno" class="form-control" required="required">
					<option value="">Seleccione Alumno</option>
					@foreach($alumno as $alu)
					<option value="{!! $alu->no_de_control !!}" {{(old('alumno',$titulacion->alumno)==$alu->no_de_control)? 'selected':''}}>{!! $alu->completo !!}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-4">
				<label for="opc_titu" class="control-label">Opción de titulación</label>
				<select id="opc_titu" name="opc_titu" class="form-control" required="">
					<option value="opc_titu">Seleccione Opción de titulación</option>
					@foreach($opcion as $op)
						<option value="{!! $op->id !!}" {{(old('opc_titu',$titulacion->opc_titu)==$op->id)? 'selected':''}}> {{ $op->reticula }} / {!! $op->nombre_opcion !!}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-4">
				<label for="proyecto" class="control-label">Nombre del proyecto</label>
				<input type="text" id="proyecto" name="proyecto" class="form-control" style="text-transform:uppercase;" value="{{ old('proyecto', $titulacion->nombre_proyecto) }}" required="">
			</div>
			<br>
			<hr>
			<br>
			<div class="col-md-12">
				<label for="asesor" class="control-label">Asesor</label>
				<select id="asesor" name="asesor" class="form-control" required="">
					<option value="asesor">Seleccione Asesor</option>
					@foreach($personal as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('asesor',$titulacion->asesor)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-4">
				<label for="presidente" class="control-label">Presidente</label>
				<select id="presidente" name="presidente" class="form-control" required="">
					<option value="presidente">Seleccione Presidente</option>
					@foreach($personal as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('presidente',$titulacion->presidente)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-4">
				<label for="secretario" class="control-label">Secretario</label>
				<select id="secretario" name="secretario" class="form-control" required="">
					<option value="secretario">Seleccione Secretario</option>
					@foreach($personal as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('secretario',$titulacion->secretario)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-4">
				<label for="vocal_propietario" class="control-label">Vocal Propietario</label>
				<select id="vocal_propietario" name="vocal_propietario" class="form-control" required="">
					<option value="vocal_propietario">Seleccione Vocal Propietario</option>
					@foreach($personal as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('vocal_propietario',$titulacion->vocal_propietario)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>

            <div class="col-md-4">
				<label for="vocal_suplente" class="control-label">Vocal Suplente</label>
				<select id="vocal_suplente" name="vocal_suplente" class="form-control" required="">
					<option value="">Seleccione Vocal Suplente</option>
					@foreach($personal as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('vocal_suplente',$titulacion->vocal_suplente)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>

            <div class="col-md-4">
				<label for="estatus" class="control-label">Estatus</label>
				<select id="estatus" name="estatus" class="form-control" required="">
					<option value="">Seleccione estatus</option>
                    <option value="ACTIVO" {!! (old('estatus',$titulacion->estatus)=='ACTIVO')? 'selected':'' !!}>Activo</option>
                    <option value="CANCELADO" {!! (old('estatus',$titulacion->estatus)=='CANCELADO')? 'selected':'' !!}>Cancelado</option>
				</select>
			</div>


			<p class="col-md-12">
				<button type="submit" class="btn btn-raised btn-primary">Guardar</button>
				<button data-toggle="modal" data-target="#modal1" class="btn btn-raised btn-primary">Cancelar</button>
			</p>

		</form>
	</div>
	<!-- Modal -->
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
@endsection
