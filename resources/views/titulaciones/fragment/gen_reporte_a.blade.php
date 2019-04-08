@extends('layouts.app')

@section('content')
	<h3>Generar reporte por año</h3>
	<form action="crear_reporte_a" method="POST" class="form" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="input-field col s6">
			<div class="col-md-4 form-group">
				<label class="control-label" for="anio">Año</label>
				<input type="text" class="form-control" id="anio1" name="anio1" value="2017">
			</div>

			<p class="col-md-12 form-group">
				<button type="submit" class="btn btn-raised btn-primary">Generar Reporte</button>
				<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
			</p>
	</form>
@endsection
