<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Impresión Definitiva</title>
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
          <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Impresión definitiva</td>
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
          @foreach($jefediv as $div) @endforeach @foreach($data as $docente) {{ $docente->completo}} @endforeach
          <br>
          @foreach($gjdiv as $genero) @if($genero->sexo_empleado=='M') JEFE @else JEFA @endif @endforeach DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
          <br>
        </strong>
      </p>
      <p align="justify">
        Los que suscriben, integrantes del Jurado de Examen Recepcional del egresado (a) cuyos datos se especifican a continuación:
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
            <td>Pasante de la carrera de:</td>
            <td>{{$t->nombre}}</td>
          </tr>
            @endforeach
            @foreach($data as $t)
          <tr>
            <td>Opción de Titulación</td>
            <td>{{$t->opcion}}</td>
          </tr>
          <tr>
            <td>Título final del trabajo de Titulación</td>
            <td>"{{$t->proyecto}}"</td>
          </tr>

        </tbody>
        </table>
        <p align="justify">
          Hacemos constar que hemos revisando su informe técnico y tenemos a bien comunicarle nuestra autorización para la liberación del mismo y su impresión definitiva.
        </p>
      </div>
      <div id="firmas">
            <p align="center"><strong>ATENTAMENTE</strong><br>
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
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">{{$t->presidente}}</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">{{$t->secretario}}</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">PRESIDENTE & ASESOR</td>
                    <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td align="center" id="titulo">SECRETARIO</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">{{$t->vocal_propietario}}</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">{{$t->vocal_suplente}}</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">VOCAL PROPIETARIO</td>
                    <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td align="center" id="titulo">VOCAL SUPLENTE</td>
                  </tr>
                </tbody>
                </table>
                @endforeach
            </div>
            <p id="cp">C.C.P. Alumno</p>
    </div>
    </div>
  </body>
</html>
