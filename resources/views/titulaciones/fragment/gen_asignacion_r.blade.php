@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">
          <center>Asignación de Revisores</center>
        </h3>
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
              <th><center>Presidente</center></th>
              <th><center>Secretario</center></th>
              <th><center>Vocal Propietario</center></th>
              <th><center>Vocal Suplente</center></th>
              <th colspan="1"></th>
              @else
              <th><center>Asesor</center></th>
              <th><center>Presidente</center></th>
              <th><center>Secretario</center></th>
              <th><center>Vocal Propietario</center></th>
              <th><center>Vocal Suplente</center></th>
              <th><center>Sinodal Externo</center></th>
              <th colspan="1"></th>
              @endif
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>
                  {{ $titulacion->asesor}}
                </td>
                <td>
                  {{ $titulacion->presidente }}
                </td>

                <td>
                  {{ $titulacion->secretario }}
                </td>

                <td>
                  {{ $titulacion->vocal_propietario}}
                </td>
                <td>
                  {{$titulacion->vocal_suplente}}
                </td>
                @if($ae->asesor_externo != 'N')
                <td>
                  {{$titulacion->asesor_externo}}
                </td>
                @endif
              </tr>
          </tbody>
        </table>
        <br>
        <form action="{{ route('crear_asignacion_r', $titulacion->id) }}" method="POST" target="_blank">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
