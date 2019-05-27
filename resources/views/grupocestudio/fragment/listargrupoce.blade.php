@extends('layouts.app')

@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-12">

					@foreach($alumno as $al)
					<h5> <b>{{$al->no_de_control}} — {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</b>
						<br>
						@endforeach
						<i>{{$grupocestudio->nombre_completo_materia}}</i></h5>
            @if (file_exists('pdf/Circulos/'.$grupocestudio->tutor.'.pdf')) <a href="{{ asset('pdf/Circulos/'.$grupocestudio->tutor.'.pdf')}}" target="_blank">Abrir Constancia de Círculos de est.</a>
            @endif
						<table class="table table-striped table-hover ">
							<thead>
								<tr>
									<th>Dia</th>
									<th>Hora</th>
									<th>Salón</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $grupocestudio->dia1 }}</td>
									<td>
										<strong>{{ $grupocestudio->hora1 }}</strong>
									</td>
									<td>
										<strong>{{ $grupocestudio->salon1}}</strong>
									</td>
									<td width="20px">
										<a href="{{ route('grupocestudio.edit', $grupocestudio->id) }}" class="btn btn-raised btn-primary">
											Editar
										</a>
									</td>
								</tr>
								<tr>
									<td>{{ $grupocestudio->dia2 }}</td>
									<td>
										<strong>{{ $grupocestudio->hora2 }}</strong>
									</td>
									<td>
										<strong>{{ $grupocestudio->salon2}}</strong>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<hr size="30">
						<br>
						<form action="{{ route('crear_constancia_ce', $grupocestudio->tutor) }}" method="POST" class="form" target="_blank">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-md-6 form-group">
								<label class="control-label" for="oficio">Oficio</label>
								<input type="text" class="form-control" id="oficio" name="oficio" placeholder="DSC-D-001/2018">
							</div>
							<p class="col-md-12 form-group">
								<button type="submit" class="btn btn-raised btn-primary">Generar PDF</button>
								<a href="{{ route('grupocestudio.index') }}" class="btn btn-raised btn-primary">Regresar</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
  @endif
@endsection
