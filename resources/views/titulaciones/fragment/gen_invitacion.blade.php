@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title"> <center>Invitación a Ceremonia de Titulación</center></h3>
				<center>
					<div class="col-md-12">
						<br>
						<h4>
							<b>{{$alumno->no_de_control}} — {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</b>
						</h4>
					</div>
				</center>
				<hr>
				<center>
					<h5>
						<i>{{$titulacion->nombre_opcion}}</i>
					</h5>
				</center>
				<table class="table table-striped table-hover">
          <thead>
            <tr>
              @if($ae->asesor_externo == 'N')
              <th><center>Asesor</center></th>
              <th colspan="3"><center>Revisores</center></th>
              <th colspan="1"></th>
              @else
              <th><center>Asesor</center></th>
              <th colspan="3"><center>Revisores</center></th>
              @endif
            </tr>
          </thead>
          <tbody>
              <tr>
                @if($ae->asesor_externo == 'N')
                <td>
                  {{$titulacion->asesor}}
                </td>
                @else
                <td>
                  {{$titulacion->asesor_externo}}
                </td>
                @endif
                <td>
                  {{ $titulacion->presidente }}
                </td>

                <td>
                  {{ $titulacion->secretario }}
                </td>

                <td>
                  {{ $titulacion->vocal_propietario}}
                </td>
              </tr>
          </tbody>
        </table>
					<br>
				<form action="{{ route('crear_invitacion', $titulacion->id)}}" method="POST" target="_blank">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-12">
							<div class="col-md-4">
								<label for="fecha" class="control-label">Fecha de Ceremonia</label>
								<input type="date" name="fecha" class="form-control" placeholder="mm/dd/aaaa">
							</div>
						<div class="col-md-4">
							<label for="lugar" class="control-label">Lugar</label>
							<input type="text" id="lugar" name="lugar" class="form-control" placeholder="SALA DE TITULACIÓN 1" style="text-transform:uppercase;" required>
						</div>
           <div class="col-md-4">
             <label for="hora" class="control-label">Hora</label>
             <input type="text" id="hora" name="hora" class="form-control" placeholder="9:00 HORAS" style="text-transform:uppercase;" required>
           </div>
          </div>
						<p class="col-md-12">
							<button type="submit" class="btn btn-raised btn-primary">Generar PDF</button>
							<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
