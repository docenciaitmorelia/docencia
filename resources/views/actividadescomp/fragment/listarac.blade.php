@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
@foreach($alumno as $al)
<h5>{{$al->no_de_control}} <br> {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</h5>
@endforeach

@if (file_exists('pdf/AC/'.$al->no_de_control.'.pdf')) <a href="{{ asset('pdf/AC/'.$al->no_de_control.'.pdf')}}" target="_blank">Abrir Constancia de Actividades Comp.</a>
@endif

	 <table class="table table-striped table-hover ">
		<thead>
			<tr>
				<th>Actividad</th>
				<th>N. Créditos</th>
				<th colspan="1">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($actividadescomp as $actcomp)
				<tr>
					<td>
						<strong>{{ $actcomp->actividad }}</strong>
					</td>
					<td>
						<strong>{{ $actcomp->creditos }}</strong>
					</td>
					<td width="20px">
						<a href="{{ route('actividadescomp.edit', $actcomp->id) }}" class="btn btn-raised btn-primary">
							Editar
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<br>
	<hr size="30">
	<br>
 	@if($ncreditos>=5)
 	<form action="{{ route('crear_constancia_ac', $al->no_de_control)}}" method="POST" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-6">
			<label for="oficio" class="control-label">Oficio:</label>
			<input type="text" id="oficio" name="oficio" class="form-control" placeholder="DSC-D-001/2018">
		</div>
		<p class="col-md-12">
			<button type="submit" class="btn btn-raised btn-primary">Generar PDF</button>
			<a href="{{ route('actividadescomp.index') }}" class="btn btn-raised btn-primary">Regresar</a>
		</p>
	</form>
	@else
	<a href="{{ route('actividadescomp.index') }}" class="btn btn-raised btn-primary">Regresar</a>
	@endif
</div>
</div>
</div>
</div>
@endsection
