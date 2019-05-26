@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Editar grupo</h3>
					<br>
					<br>
					<form action="{{ route('grupocestudio.update', $grupo->id) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT')}}
            <div class="col-md-4">
      				<label for="alumno" class="control-label">Tutor</label>
      				<input readonly type="text" id="alumno" name="alumno" class="form-control" value="{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}" style="text-transform:uppercase;">
      			</div>
						<div class="col-md-4 form-group">
							<label for="materia" class="control-label">Materia</label>
							<select id="materia" name="materia" class="form-control" required>
								<option value="">Seleccione Materia</option>
								@foreach($materia as $mat)
								<option value="{!! $mat->id !!}" {{(old('materia',$grupo->materia)==$mat->id)? 'selected':''}}>{!! $mat->nombre_completo_materia !!}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label for="ciclo" class="control-label">Ciclo Escolar</label>
							<select id="ciclo" name="ciclo" class="form-control" required>
								<option value="">Seleccione Ciclo</option>
              	<option value="1" {{(old('ciclo',$grupo->ciclo_escolar)==1)? 'selected':''}}>ENERO-JUNIO</option>
          			<option value="2" {{(old('ciclo',$grupo->ciclo_escolar)==2)? 'selected':''}}>AGOSTO-DICIEMBRE</option>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label for="dia1" class="control-label">Día</label>
							<select id="dia1" name="dia1" class="form-control" required>
								<option value="">Seleccione día</option>
								<option value="L" {!! (old('dia1',$grupo->dia1)=='L')? 'selected':'' !!}>Lunes</option>
								<option value="M" {{(old('dia1',$grupo->dia1)=='M')? 'selected':''}}>Martes</option>
								<option value="X" {{(old('dia1',$grupo->dia1)=='X')? 'selected':''}}>Miércoles</option>
								<option value="J" {{(old('dia1',$grupo->dia1)=='J')? 'selected':''}}>Jueves</option>
								<option value="V" {{(old('dia1',$grupo->dia1)=='V')? 'selected':''}}>Viernes</option>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label for="hora1" class="control-label">Hora</label>
							<input type="text" id="hora1" name="hora1" class="form-control" value="{{ old('hora1', $grupo->hora1) }}" required>
						</div>
						<div class="col-md-4 form-group">
							<label for="salon1" class="control-label">Salón</label>
							<input type="text" id="salon1" name="salon1" class="form-control" style="text-transform:uppercase;" value="{{ old('salon1', $grupo->salon1) }}" required>
						</div>
						<div class="col-md-4 form-group">
							<label for="dia2" class="control-label">Día</label>
							<select id="dia2" name="dia2" class="form-control" required>
								<option value="">Seleccione día</option>
								<option value="L" {!! (old('dia2',$grupo->dia2)=='L')? 'selected':'' !!}>Lunes</option>
								<option value="M" {!! (old('dia2',$grupo->dia2)=='M')? 'selected':'' !!}>Martes</option>
								<option value="X" {!! (old('dia2',$grupo->dia2)=='X')? 'selected':'' !!}>Miércoles</option>
								<option value="J" {!! (old('dia2',$grupo->dia2)=='J')? 'selected':'' !!}>Jueves</option>
								<option value="V" {!! (old('dia2',$grupo->dia2)=='V')? 'selected':'' !!}>Viernes</option>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="hora2">Hora</label>
							<input type="text" class="form-control" id="hora2" name="hora2" value="{{ old('hora2', $grupo->hora2) }}" required>
						</div>

						<div class="col-md-4 form-group">
							<label for="salon2" class="control-label">Salón</label>
							<input type="text" id="salon2" name="salon2" class="form-control" style="text-transform:uppercase;" value="{{ old('salon2', $grupo->salon2) }}" required>
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
</div>
@endsection
