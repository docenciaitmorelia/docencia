@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Generar reporte por año</h3>
	<form action="crear_reporte_a" method="POST" class="form" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-12">
				<div class="col-md-6 form-group">
					<label for="oficio" class="control-label">Oficio</label>
					<input type="text" id="oficio" name="oficio" class="form-control" placeholder="DSC-D-001/2018" required>
				</div>
			<div class="col-md-4 form-group">
				<label class="control-label" for="anio">Año</label>
				<input type="text" class="form-control" id="anio1" name="anio1" value="2017">
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
