@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Generar horario de círculos de estudios</h3>
					<form action="crear_horario" method="POST" class="form" target="_blank">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-4 form-group">
							<label for="semestre" class="control-label">Semestre</label>
							<select id="semestre" name="semestre" class="form-control">
								<option value="">Seleccione semestre</option>
								<option value="E-J">ENERO-JUNIO</option>
								<option value="A-D">AGOSTO-DICIEMBRE</option>
							</select>
						</div>

						<div class="col-md-12 form-group">
							<button type="submit" class="btn btn-raised btn-primary">Generar horario</button>
							<a href="{{ route('grupocestudio.index') }}" class="btn btn-raised btn-primary">Regresar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection