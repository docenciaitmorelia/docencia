@extends('layouts.app')

@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">
					<h3>Catalogo de Actividades</h3>
	<div class="col-md-4">
		<a href="{{ route('catalogoac.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
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
@include('catalogoac.fragment.info')
<table class="table table-striped table-hover ">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>N. Créditos</th>
			<th colspan="1">&nbsp;</th>
			<th colspan="1">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach($catalogoac as $catalogoact)
			<tr>

				<td>
					<strong>{{ $catalogoact->actividad }}</strong>
				</td>
				<td>
					<strong>{{ $catalogoact->creditos }}</strong>
				</td>
				<td width="20px">
					<a href="{{ route('catalogoac.edit', $catalogoact->id) }}"class="btn btn-raised btn-primary">
						<i class="material-icons">create</i>
					</a>
				</td>
				<td width="20px">
					<form action="{{ route('catalogoac.destroy', $catalogoact->id) }}" method="POST">
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
