<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Liberación de Proyecto</title>
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
    <table align="right">
        <tr>
          <td colspan="2" align="right"><b>Morelia, Mich.,&nbsp; {{$date}}</b></td>
        </tr>
        <tr>
          <td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>{{$secc}}</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><b>OFICIO:&nbsp;</b>{{$nof}}</td>
        </tr>
        <tr>
          <td colspan="2" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Liberación de Proyecto para Titulación Integral</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="col-md-12" id="den">
      <p>
        <strong>
          @foreach($data as $docente) {{ $docente->grado}} @endforeach @foreach($data as $docente) {{ $docente->completo}} @endforeach
          <br>
          @foreach($data as $docente) @if($docente->sexo=='M') JEFE @else JEFA @endif @endforeach DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
          <br>
        </strong>
      </p>
      <p align="justify">
        Por este medio, le informo que ha sido liberado el siguiente proyecto para la Titulación Integral.
      </p>
      <table class="table table-bordered" bordercolor="black">
          <tbody>
              @foreach($data3 as $t)
            <tr>
              <td>Nombre del egresado (a):</td>
              <td>{{$t->completo}}</td>
            </tr>
              @endforeach
            <tr>
              <td>Número de control</td>
              <td>{{$nc}}</td>
            </tr>
              @foreach($data2 as $t)
            <tr>
              <td>Carrera de:</td>
              <td>{{$t->nombre}}</td>
            </tr>
              @endforeach
              @foreach($data as $t)
            <tr>
              <td>Opción de Titulación</td>
              <td>{{$t->opcion}}</td>
            </tr>
            <tr>
              <td>Nombre del proyecto:</td>
              <td>"{{$t->proyecto}}"</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <p align="justify">
          Agradezco de antemano su valioso apoyo en esta importante actividad para la formación profesional de nuestros egresados.
        </p>
      </div>
      <div id="firmas">
            <p align="center"><strong>ATENTAMENTE</strong><br>
              <i id="tec">"Técnica, progreso de México"</i>
            </p>
            <br>
            <div class="col-md-12">
              <table align="center">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">NOMBRE</td>
                    <td align="center">Nombre</td>
                    <td align="center">NOMBRE</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">Jefe del Depto</td>
                    <td align="center">Asesor</td>
                    <td align="center" id="titulo">Presidente de Academia</td>
                  </tr>
                </tbody>
                </table>
            </div>
            <p id="cp">C.p. Asesor<br>Alumno interesado<br>Archivo</p>
    </div>
    </div>
  </body>
</html>