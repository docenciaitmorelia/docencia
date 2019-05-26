@extends('layouts.app')

@section('content')
@if(Auth::user()->rol == 'Alumno')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
@foreach($alumno as $al)
<h5>{{$al->no_de_control}} <br> {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</h5>
@endforeach

	 <table class="table table-striped table-hover ">
		<thead>
			<tr>
				<th>Actividad</th>
				<th>N. Créditos</th>
        <th>Del</th>
        <th>Al</th>
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
          <td>
            <strong>{{ $actcomp->fecha_del }}</strong>
          </td>
          <td>
            <strong>{{ $actcomp->fecha_al }}</strong>
          </td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<br>
	<hr size="30">
	<br>
  <a href="{{ route('home') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
</div>
</div>
</div>
</div>
@endif
@endsection
