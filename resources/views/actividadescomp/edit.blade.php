@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Editar Actividad Complementaria</h3>
		<br>
		<br>
		<form action="{{ route('actividadescomp.update', $actividadescomp->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT')}}
			<div class="col-md-12">
			<div class="col-md-6">
				<label for="actividad" class="control-label">Nombre de la Actividad</label>
				<input type="text" id="actividad" name="actividad" class="form-control" style="text-transform:uppercase;" value="{{ old('actividad', $actividadescomp->actividad) }}" required>
			</div>

			<div class="col-md-6">
				<label for="alumno" class="control-label">Alumno</label>
				<input readonly type="text" id="alumno" name="alumno" class="form-control" value="{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}" style="text-transform:uppercase;">
			</div>
		</div>
		<div class="col-md-12">
      <div class="col-md-6">
          <label for="tipo" class="control-label">Tipo de Actividad</label>
                <select id="tipo" name="tipo" class="form-control" data-live-search="true" required>
                    <option value="">Seleccione Tipo de actividad</option>
                    @foreach($tipo as $t)
                    <option value="{!! $t->id !!}" {{(old('tipo',$actividadescomp->tipo)==$t->id)? 'selected':''}}>{!! $t->actividad !!}</option>
                    @endforeach
                </select>
        </div>

			<div class="col-md-3">
				<label for="creditos" class="control-label">Número de créditos</label>
				<input type="number" id="creditos" name="creditos" max="2" class="form-control" value="{{ old('creditos', $actividadescomp->creditos) }}" required>
			</div>

      <div class="col-md-3">
				<label for="horas" class="control-label">Horas</label>
				<input type="text" id="horas" name="horas" class="form-control" value="0" style="text-transform:uppercase;" value="{{ old('horas', $actividadescomp->horas) }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<label for="fecha_del" class="control-label">Del</label>
				<input type="text" id="fecha_del" name="fecha_del" class="form-control" style="text-transform:uppercase;" value="{{ old('fecha_del', $actividadescomp->fecha_del) }}" required>
			</div>

			<div class="col-md-6">
				<label for="fecha_al" class="control-label">Al</label>
				<input type="text" id="fecha_al" name="fecha_al" class="form-control" style="text-transform:uppercase;" value="{{ old('fecha_al', $actividadescomp->fecha_al) }}" required>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<label for="calificacion" class="control-label">Calificación</label>
				<input type="number" id="calificacion" name="calificacion" class="form-control" step=".01" value="{{ old('calificacion', $actividadescomp->calificacion) }}" required>
			</div>

			<div class="col-md-8">
				<label for="docente_resp" class="control-label">Docente Responsable</label>
				<select id="docente_resp" name="docente_resp" class="form-control" required>
					<option value="">Seleccione docente</option>
					@foreach($docente as $doc)
					<option value="{!! $doc->rfc !!}" {{(old('docente_resp',$actividadescomp->docente_resp)==$doc->rfc)? 'selected':''}}>{!! $doc->completo !!}</option>
					@endforeach
				</select>
			</div>
		</div>
			<p class="col-md-12">
				<button type="submit" class="btn btn-raised btn-primary">Guardar</button>
				<a href="{{ route('actividadescomp.index') }}" class="btn btn-raised btn-primary">Cancelar</a>
			</p>

		</form>
	</div>
	</div>
	</div>
	</div>
	</div>
@endsection
