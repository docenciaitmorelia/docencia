@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'Jefe de Docencia' || Auth::user()->rol == 'Alumno')
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title">Expediente de Propuesta y Proyecto de Titulación</h3>

  				<div class="col-md-6">
  					<strong>Alumno: </strong>{{$alumno->no_de_control}} — {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}
  				</div>

          <div class="col-md-12">
  					<strong>Proyecto:</strong> {{$titulacion->nombre_proyecto}}
  				</div>
          <div class="col-md-6">
            <strong>Opción de Titulación:</strong> {{$titulacion->nombre_opcion}}
          </div>
          <div class="col-md-6">
            <strong>Asesor(a):</strong> {{ $titulacion->asesor }}
          </div>
					<table class="table table-striped table-hover">
            <caption><h3>Propuesta de Proyecto</h3></caption>
						<thead>
							<tr>
                <th></th>
								<th colspan="3"><center>Revisores</center></th>
							</tr>
						</thead>
						<tbody>

								<tr>
                  <td><strong>Revisores:</strong></td>
									<td>{{ $titulacion->presidente }}</td>
									<td>{{ $titulacion->secretario }}</td>
									<td>{{ $titulacion->vocal_propietario}}</td>
								</tr>
                <tr>
                  <td><strong>Veredicto:</strong></td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                      @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td><strong>Observaciones:</strong></td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->comentarios }}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROPUESTA")
                      {{ $revision->comentarios }}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROPUESTA")
                      {{ $revision->comentarios }}<BR>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROPUESTA")
                      {{ $revision->comentarios }}<BR>
                      @endif
                    @endforeach
                  </td>
                </tr>
						</tbody>
					</table>


            <!-- PROYECTO DE TITULACIÓN -->

            <table class="table table-striped table-hover">
              <caption><h3>Proyecto de Titulación</h3></caption>
  						<thead>
  							<tr>
                  <th></th>
  								<th><center>Presidente</center></th>
  								<th><center>Secretario</center></th>
  								<th><center>Vocal Propietario</center></th>
  								<th><center>Vocal Suplente</center></th>
  							</tr>
  						</thead>
  						<tbody>

  								<tr>
                    <td><strong>Revisores:</strong></td>
  									<td>{{ $titulacion->presidente }}</td>
  									<td>{{ $titulacion->secretario }}</td>
  									<td>{{ $titulacion->vocal_propietario}}</td>
                    <td>{{ $titulacion->vocal_suplente}}</td>
  								</tr>
                  <tr>
                    <td><strong>Veredicto:</strong></td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                        @endif
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Observaciones:</strong></td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->comentarios }}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROYECTO")
                        {{ $revision->comentarios }}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROYECTO")
                        {{ $revision->comentarios }}<BR>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROYECTO")
                        {{ $revision->comentarios }}<BR>
                        @endif
                      @endforeach
                    </td>
                  </tr>
  						</tbody>
  					</table>
						<div class="col-md-12">
							@if(Auth::user()->rol == 'Jefe de Docencia')
									<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
							@elseif(Auth::user()->rol == 'Alumno')
								<a href="{{ route('home') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
							@endif
						</div>
				</div>
			</div>
		</div>
	</div>
@endif
@endsection
