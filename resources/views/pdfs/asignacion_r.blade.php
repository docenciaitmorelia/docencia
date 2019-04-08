<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asignación de Revisores</title>
  <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/ripples.min.css') }}">
    <script type="text/javascript" src=" {{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/ripples.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/material.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
  <body>
    <div id="contenido">
      <p align="center">
        <strong>
          {{$dep}}
          <br>
          REVISORES PARA OPCIÓN DE TITULACIÓN
        </strong>
      </p>
      <br>
      <table class="table table-bordered" bordercolor="black">
          <tbody>
              @foreach($data3 as $t)
            <tr>
              <td>Alumno(a):</td>
              <td>{{$t->completo}}</td>
            </tr>
              @endforeach
              @foreach($data as $t)
            <tr>
              <td>Opción de Titulación:</td>
              <td>{{$t->opcion}}</td>
            </tr>
            <tr>
              <td>Título del trabajo</td>
              <td>"{{$t->proyecto}}"</td>
            </tr>
            <tr>
              <td>Asesor</td>
              <td>{{$t->asesor}}</td>
            </tr>
          </tbody>
        </table>
        <p align="justify">
          <strong>REVISORES</strong>
        </p>
        <table class="table table-bordered" bordercolor="black">
          <thead>
            <tr>
              <th>Cargo</th>
              <th>Nombre del(la) profesor(a)</th>
              <th>Firma</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Presidente:</td>
              <td>{{$t->presidente}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Secretario</td>
              <td>{{$t->secretario}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Propietario</td>
              <td>{{$t->vocal_propietario}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Suplente</td>
              <td>{{$t->vocal_suplente}}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
        @endforeach
      <p align="justify">
          Después que revisen su proyecto y realice las correcciones necesarias, los revisores firmaran de conformidad. Entonces solicita el Oficio de Liberación de Proyecto.
        </p>
      <div class="col-md-12" id="firmas">
            <br>
            <div class="col-md-12">
              <table align="center">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1" align="center">NOMBRE</td>
                    <th colspan="1">&nbsp;&nbsp;&nbsp;</th>
                    <td colspan="1" align="center">Nombre</td>
                    <th colspan="1">&nbsp;&nbsp;&nbsp;</th>
                    <td colspan="1" align="center">NOMBRE</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">Jefe del Depto</td>
                    <th>&nbsp;</th>
                    <td align="center">Asesor</td>
                    <th>&nbsp;</th>
                    <td align="center" id="titulo">Presidente de Academia</td>
                  </tr>
                </tbody>
                </table>
            </div>
    </div>
    </div>
  </body>
</html>
