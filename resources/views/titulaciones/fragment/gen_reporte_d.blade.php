@extends('layouts.app')

@section('content')
	<h3>Generar reporte por docente</h3>
	<form action="crear_reporte_d" method="POST" class="form" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-6 form-group">
			<label for="oficio" class="control-label">Oficio</label>
			<input type="text" id="oficio" name="oficio" class="form-control" placeholder="DSC-D-001/2018">
		</div>
		<div class="col-md-12 form-group">
			<label for="docente" class="control-label">Docente</label>
			<select id="docente" name="docente" class="form-control">
				<option value="">Seleccione Docente</option>
				@foreach($personal as $doc)
				<option value="{!! $doc->rfc !!}">{!! $doc->completo !!}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6 form-group">
			<label for="semestre" class="control-label">Semestre</label>
			<select id="semestre" name="semestre" class="form-control">
				<option value="">Seleccione semestre</option>
				<option value="E-J">ENERO-JUNIO</option>
				<option value="A-D">AGOSTO-DICIEMBRE</option>
			</select>
		</div>
		<div class="col-md-6 form-group">
			<label class="control-label" for="anio">Año</label>
			<input type="text" class="form-control" id="anio" name="anio">
		</div>

		<p class="col-md-12 form-group">
			<button type="submit" class="btn btn-raised btn-primary">Generar Reporte</button>
			<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
		</p>
	</form>
@endsection
