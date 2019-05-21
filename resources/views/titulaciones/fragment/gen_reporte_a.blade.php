@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Reporte de titulaciones</h3>
	<form action="crear_reporte_a" method="POST" class="form" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-4 form-group">
				<label for="semestre" class="control-label">Semestre</label>
				<select id="semestre" name="semestre" class="form-control">
					<option value="">Seleccione periodo...</option>
					<option value="E-J">ENERO-JUNIO</option>
					<option value="A-D">AGOSTO-DICIEMBRE</option>
				</select>
			</div>
			<div class="col-md-4 form-group">
				<label class="control-label" for="anio">Año</label>
				<input type="text" class="form-control" id="anio" name="anio" value="2017">
			</div>

			<p class="col-md-12 form-group">
				<button type="submit" class="btn btn-raised btn-primary">Generar Reporte</button>
				<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
			</p>
	</form>
</div>
</div>
</div>
</div>
</div>
@endsection
