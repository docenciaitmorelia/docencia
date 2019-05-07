@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'Docente')
<div class="row">
	<div class="col">
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title">Autorización de Propuesta y Proyecto de Titulación</h3>

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
                    <?php $propuestas_aprobadas=0; ?>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                          <?php
                          if($revision->veredicto == "APROBADO"){
                            $propuestas_aprobadas++;
                          }
                          ?>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                        <?php
                        if($revision->veredicto == "APROBADO"){
                          $propuestas_aprobadas++;
                        }
                        ?>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                          <?php
                          if($revision->veredicto == "APROBADO"){
                            $propuestas_aprobadas++;
                          }
                          ?>
                      @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROPUESTA")
                        {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                          <?php
                          if($revision->veredicto == "APROBADO"){
                            $propuestas_aprobadas++;
                          }
                          ?>
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
          @if($propuestas_aprobadas<4)
				    <div class="col-md-12">
    					<form action="{{ route('proyectoTitulacionCtl.store') }}" method="POST">
    						@csrf
                <input type="hidden" name="id_titulacion" value="{{$titulacion->id}}">
                <input type="hidden" name="revisor" value="{{Auth::user()->name}}">
                <input type="hidden" name="tipo_revision" value="PROPUESTA">
                <div class="form-group input-group col-md-12">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Observaciones a la Propuesta:</span>
                  </div>
                  <textarea name="comentarios" class="form-control" aria-label="Comentarios" required>Sin Comentarios...</textarea>
                </div>
    						<div class="col-md-6">
                  <?php $veredicto=""; ?>
                  @foreach($revisiones as $revision)
                    @if($revision->revisor == Auth::user()->name && $revision->tipo_revision == "PROPUESTA")
                      <?php $veredicto=$revision->veredicto; ?>
                      @break
                    @endif
                  @endforeach
                    <button type="submit" name="veredicto" value="APROBADO" class="btn btn-raised btn-primary" {{$veredicto=="APROBADO"?"DISABLED":""}}><i class="material-icons">check</i>Autorizar Propuesta</button>
      							<button type="submit" name="veredicto" value="RECHAZADO" class="btn btn-raised btn-primary" {{$veredicto=="RECHAZADO"?"DISABLED":""}}><i class="material-icons">clear</i>Rechazar Propuesta</button>
                </div>
    					</form>
              <div class="col-md-6">
                <a href="{{ route('proyectoTitulacionCtl.index') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
              </div>
				    </div>
            @endif


            <!-- PROYECTO DE TITULACIÓN -->

            @if($propuestas_aprobadas==4)
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
                      <?php $revisores_que_aprueban=0; ?>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_presidente && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                            <?php
                            if($revision->veredicto == "APROBADO"){
                              $revisores_que_aprueban++;
                            }
                            ?>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_secretario && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                          <?php
                          if($revision->veredicto == "APROBADO"){
                            $revisores_que_aprueban++;
                          }
                          ?>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_propietario && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                            <?php
                            if($revision->veredicto == "APROBADO"){
                              $revisores_que_aprueban++;
                            }
                            ?>
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @foreach($revisiones as $revision)
                        @if($revision->revisor == $titulacion->rfc_vocal_suplente && $revision->tipo_revision == "PROYECTO")
                          {{ $revision->veredicto }} el {{ $revision->fecha_revision}}<BR>
                            <?php
                            if($revision->veredicto == "APROBADO"){
                              $revisores_que_aprueban++;
                            }
                            ?>
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
              @if($revisores_que_aprueban < 4)
  				    <div class="col-md-12">
      					<form action="{{ route('proyectoTitulacionCtl.store') }}" method="POST">
      						@csrf
                  <input type="hidden" name="id_titulacion" value="{{$titulacion->id}}">
                  <input type="hidden" name="revisor" value="{{Auth::user()->name}}">
                  <input type="hidden" name="tipo_revision" value="PROYECTO">
                  <div class="form-group input-group col-md-12">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Observaciones al Proyecto de Titulación:</span>
                    </div>
                    <textarea name="comentarios" class="form-control" aria-label="Comentarios" required>Sin Comentarios...</textarea>
                  </div>
      						<div class="col-md-6">
                    <?php $veredicto=""; ?>
                    @foreach($revisiones as $revision)
                      @if($revision->revisor == Auth::user()->name && $revision->tipo_revision == "PROYECTO")
                        <?php $veredicto=$revision->veredicto; ?>
                        @break
                      @endif
                    @endforeach
                    <button type="submit" name="veredicto" value="APROBADO" class="btn btn-raised btn-primary" {{$veredicto=="APROBADO"?"DISABLED":""}}><i class="material-icons">check</i>Autorizar Proyecto</button>
      							<button type="submit" name="veredicto" value="RECHAZADO" class="btn btn-raised btn-primary" {{$veredicto=="RECHAZADO"?"DISABLED":""}}><i class="material-icons">clear</i>Rechazar Proyecto</button>
      						</div>
      					</form>
                <div class="col-md-6">
                  <a href="{{ route('proyectoTitulacionCtl.index') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
                </div>
  				    </div>
              @else
                <div class="col-md-6">
                  <a href="{{ route('proyectoTitulacionCtl.index') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
                </div>
              @endif
            @endif
				</div>
			</div>
		</div>
	</div>
@endif
@endsection
