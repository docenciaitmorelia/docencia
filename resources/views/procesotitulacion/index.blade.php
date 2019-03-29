@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="{{ route('procesotitulacion.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
				<form action="" method="GET" class="form-horizontal">
				<div class="col-md-6 form-group">
					<input type="text" id="s" name="s" style="text-transform:uppercase;" placeholder="Buscar..." class="form-control">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
				</div>
				</form>
			<br>
			<br>
			<br>
			<br>
			@include('procesotitulacion.fragment.info')
			<h3>Proceso de Titulaciones</h3>
			<table class="table table-striped table-hover ">
				<thead>
					<tr>
						<th>Opción de Titulación</th>
						<th>Orden</th>
			            <th>Descripción</th>
						<th colspan="1">&nbsp;</th>
						<th colspan="1">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@foreach($procesotitulacion as $procesot)
						<tr>
							<td>
								<strong>{{ $procesot->nombre_opcion }}</strong>
							</td>
							<td>
								<strong>{{ $procesot->orden }}</strong>
							</td>
			                <td>
			                    <strong>{{ $procesot->descripcion}}</strong>
			                </td>
							<td width="20px">
								<a href="{{ route('procesotitulacion.edit', $procesot->id) }}"class="btn btn-raised btn-primary">
									<i class="material-icons">create</i>
								</a>
							</td>
							<td width="20px">
								<form action="{{ route('procesotitulacion.destroy', $procesot->id) }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="DELETE">
									<button class="btn btn-raised btn-primary"><i class="material-icons">clear</i></button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
@endif
@endsection
