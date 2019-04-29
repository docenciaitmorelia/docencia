@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Actividades Complementarias</h3>

	<div class="col-md-4">
		<a href="{{ route('actividadescomp.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
	</div>
	<form action="" method="GET" class="form-horizontal">
        <div class="col-md-6 form-group">
            <input type="text" id="busqueda" name="busqueda" placeholder="Buscar..." class="form-control">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
        </div>
	</form>
	<table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Créditos</th>
                <th>Calificación</th>
                <th>Alumno</th>
                <th colspan="1">&nbsp;</th>

            </tr>
        </thead>
		<tbody>
			@foreach($actividades as $act)
				<tr>
                    <td>
						<strong>{{ $act->actividad }}</strong>
					</td>
					<td>
						<strong>{{ $act->creditos }}</strong>
					</td>
					<td>
						<strong>{{ $act->calificacion }}</strong>
					</td>
					<td><center>{{ $act->no_de_control }}</center></td>
					<td>
						<center><a href=" {{ route('listar_ac', $act->no_de_control) }}" data-target="ac" class="btn btn-raised btn-primary">Detalles del Alumno</a></center>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $actividades->render() !!}
</div>
</div>
</div>
</div>
</div>


@endsection
