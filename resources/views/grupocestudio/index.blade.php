@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Grupos de Círculo de estudios</h3>
					<div class="col-md-4">
						<a href="{{ route('grupocestudio.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
					</div>
					<form action="" method="GET" class="form-horizontal">
						<div class="col-md-6 form-group">
							<input type="text" id="busqueda" name="busqueda" style="text-transform:uppercase;" placeholder="Buscar..." class="form-control">
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
						</div>
					</form>
					<br>
					<br>
					<br>
					<table class="table table-striped table-hover ">
						<thead>
							<tr>
								<th>Tutor</th>
								<th>Materia</th>
								<th>Ciclo Escolar</th>
                <th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($grupocestudio as $grupo)
							<tr>
								<td>{{ $grupo->tutor }}</td>
								<td><strong>{{ $grupo->nombre_completo_materia }}</strong></td>
								<td><strong>@if($grupo->ciclo_escolar==1) ENERO-JUNIO @else AGOSTO-DICIEMBRE @endif</strong></td>
								<td colspan="3" align="center">
									<a href="{{ route('listar_grupo', $grupo->id)}}" data-target="grupo" class="btn btn-raised btn-primary">Detalles</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
