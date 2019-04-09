<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Constancia de Actividades complementarias</title>
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
        <div id="datos1">
            <table align="right">
                <tr>
                  <td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>{$secc}}</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><b>OFICIO:&nbsp;</b>{{$nof}}</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><b>Morelia, Mich.,&nbsp; {{$date}}</b></td>
                </tr>
                <tr>
                  <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Constancia de actividades complementarias</td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="servesc">
          <p align="justify">
            @foreach($data7 as $docente){{ $docente->especializacion}} @endforeach @foreach($data7 as $docente) {{ $docente->completo}} @endforeach
            <br>
            @foreach($data7 as $docente)@if($docente->sexo=='M')JEFE @else JEFA @endif @endforeach DEL DEPARTAMENTO DE SERVICIOS ESCOLARES
            <br>
            PRESENTE
          </p>
        </div>
        <div id="texto1">
          <p align="justify">
            Por medio de la presente se hace <strong>CONSTAR</strong> que de acuerdo a los expedientes de este departamento y al seguimiento de actividades complementarias,@foreach($data2 as $alumno) @if($alumno->sexo=='M') el @else la @endif <strong>C. {{$alumno->completo}}</strong>,@if($alumno->sexo=='M') alumno @else alumna @endif @endforeach del Instituto Tecnológico de Morelia, de la carrera @foreach($data4 as $carrera) <strong>{{$carrera->nombre}}</strong>@endforeach, con número de control <strong>{{$nc}}</strong>, ha cumplido con los <strong>CINCO créditos correspondientes a las actividades complementarias</strong>, obteniendo un nivel de desempeño de: <strong>@if($data3==4||$data3>=3.5)Excelente, @elseif($data3<=3.49 && $data3>=2.5) Notable, @elseif($data3<=2.49 && $data3>=1.5) Bueno, @elseif($data3<=1.49 && $data3>=1) Suficiente, @else Insuficiente, @endif</strong> de la siguiente manera:
          </p>
        </div>
        <br>
        <br>
        <div id="creditos">
              <table class="table table-bordered" bordercolor="black">
                  <thead align="center">
                      <tr>
                          <th class="text-center">Actividad</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">N. Créditos</th>
                          <th class="text-center">Calif.</th>
                      </tr>
              </thead>
              <tbody>
                @foreach($data as $acomplementaria)
                  <tr>
                    <td>{{ $acomplementaria->actividad }}</td>
                    <td align="center">
                      @if($acomplementaria->fecha_del != $acomplementaria->fecha_al)
                      {{ $acomplementaria->fecha_del }} A {{$acomplementaria->fecha_al }}
                      @elseif($acomplementaria->fecha_del == $acomplementaria->fecha_al)
                      {{ $acomplementaria->fecha_del }}
                      @endif
                    </td>
                    <td align="center">
                      {{ $acomplementaria->creditos }}
                    </td>
                    <td align="center">
                      {{ $acomplementaria->calificacion }}
                    </td>
                  </tr>
                @endforeach
                 <tr>
                    <td colspan="3" align="right">
                      <strong>Promedio</strong>
                    </td>
                    <td align="center">
                      <strong>{{ $data3 }}</strong>
                    </td>
                  </tr>
              </tbody>
            </table>
        </div>
        <br>
        <br>
        <div id="texto2">
            <p align="justify">
              Se emite la presente constancia para su registro correspondiente en el expediente escolar del estudiante. Agradeciendo de antemano su atención a la presente, quedo a sus órdenes.
            </p>
        </div>
        <br>
        <br>
        <div id="firmas">
            <p align="center">
                <strong>ATENTAMENTE</strong>
                <br>
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
                            <td align="center">@foreach($data5 as $docente) {{ $docente->especializacion}} {{ $docente->completo}} @endforeach</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">@foreach($data6 as $docente) {{ $docente->especializacion}} @endforeach @foreach($data6 as $docente) {{ $docente->completo}} @endforeach</td>
                        </tr>
                        <tr>
                            <td align="center" id="titulo">@foreach($data5 as $docente) @if($docente->sexo=='M')Jefe @else Jefa @endif @endforeach del Departamento de Sistemas y Computación</td>
                            <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td align="center" id="titulo">@foreach($data6 as $docente) @if($docente->sexo=='M')Jefe @else Jefa @endif @endforeach del Proyecto Docencia del Depto. de Sistemas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div id="cp">
            <p id="cp">Cp. Archivo</p>
              </div>
    </div>
  </body>
</html>
