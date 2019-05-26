<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Constancia de Actividades complementarias</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
  <body>
    <div id="contenido">
        <div id="datos1">
            <table align="right" width="50%" style="font-size: 10pt;">
                <tr>
                  <td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b> {{$data5->descripcion_area}}</td>
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
						{{$data7->jefe_area}}
						<br>
						@foreach($gjesc as $genero) @if($genero->sexo_empleado=='M') JEFE @else JEFA @endif @endforeach DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
						<br>
            PRESENTE
          </p>
        </div>
        <div id="texto1">
          <p align="justify">
            Por medio de la presente se hace <strong>CONSTAR</strong> que de acuerdo a los expedientes de este departamento y al seguimiento de actividades complementarias,@foreach($data2 as $alumno) @if($alumno->sexo=='M') el @else la @endif <strong>C. {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombre_alumno}}</strong>,@if($alumno->sexo=='M') alumno @else alumna @endif @endforeach del Instituto Tecnológico de Morelia, de la carrera @foreach($data4 as $carrera) <strong>{{$carrera->nombre}}</strong>@endforeach, con número de control <strong>{{$nc}}</strong>, ha cumplido con los <strong>CINCO créditos correspondientes a las actividades complementarias</strong> quedando de la siguiente manera:
          </p>
        </div>
        <div id="creditos">
              <table border="1" bordercolor="black" align="center" style="height: 150px;">
                  <thead align="center">
                      <tr>
                          <th class="text-center" width="60%">Actividad</th>
                          <th class="text-center" width="20%">Fecha</th>
                          <th class="text-center" width="15%">N. Créditos</th>
                      </tr>
              </thead>
              <tbody>
                @foreach($data as $acomplementaria)
                  <tr>
                    <td style="font-size: 9pt;">{{ $acomplementaria->actividad }}</td>
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
                  </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div id="texto2">
            <p align="justify">
              Se emite la presente constancia para su registro correspondiente en el expediente escolar del estudiante. Agradeciendo de antemano su atención a la presente, quedo a sus órdenes.
            </p>
        </div>
        <div id="firmas">
            <p align="center">
                <strong>ATENTAMENTE</strong>
                <br>
                <i id="tec">"Técnica, progreso de México"</i>
            </p>
            <br>
            <div class="col-md-12">
                <table align="center" width='100%'>
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">{{$data5->jefe_area}}</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">{{$docencia->grado}} {{$docencia->nombre_empleado}} {{$docencia->apellidos_empleado}}</td>
                        </tr>
                        <tr>
                            <td align="center" id="titulo">@if($docencia->sexo_empleado=='M') JEFE @else JEFA @endif  DEL {{$data5->descripcion_area}}</td>
                            <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td align="center" id="titulo">@foreach($data6 as $docente) @if($docente->sexo=='M')JEFE @else JEFA @endif @endforeach DEL PROYECTO DOCENCIA DEL {{$data5->descripcion_area}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div id="cp">
            <p id="cp">Cp. Archivo</p>
              </div>
    </div>
  </body>
</html>
