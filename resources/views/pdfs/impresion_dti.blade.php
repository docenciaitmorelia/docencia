<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Impresión Definitiva</title>
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
          <td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>{{$seccion->descripcion_area}}</td>
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
    <br>
    <div class="col-md-12" id="den">
      <p>
        <strong>
  			     {{ $jefediv->jefe_area}}
  				<br>
  				@if($gjdiv->sexo_empleado=='M') JEFE @else JEFA @endif DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
  				<br>
  			</strong>
  		</p>
      <p align="justify">
        Los que suscriben, integrantes del Jurado de Examen Recepcional del egresado (a) cuyos datos se especifican a continuación:
      </p>
      <table border="1" bordercolor="black">
        <tbody>
          <tr>
            <td width="25%">Nombre @if($alumno->sexo=='M') del&nbsp;egresado: @else de&nbsp;la&nbsp;egresada: @endif</td>
            <td>{{$alumno->completo}}</td>
          </tr>
          <tr>
            <td>Número de control:</td>
            <td>{{$alumno->no_de_control}}</td>
          </tr>
          <tr>
            <td>Pasante de la carrera de:</td>
            <td>{{$carrera->nombre}}</td>
          </tr>
          <tr>
            <td>Opción de Titulación:</td>
            <td>{{$titu->nombre_opcion}}</td>
          </tr>
          <tr>
            <td>Título final del trabajo de Titulación:</td>
            <td>"{{$titu->nombre_proyecto}}"</td>
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
                    <th rowspan="2" colspan="3">&nbsp;</th>
                    <th rowspan="2" colspan="3">&nbsp;</th>
                    <th rowspan="2" colspan="3">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">{{$titu->pg}} {{$titu->presidente}}</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">{{$titu->sg}} {{$titu->secretario}}</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">@if($ae->asesor_externo != 'N') PRESIDENTE @else PRESIDENTE & ASESOR @endif</td>
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
                    <td align="center">{{$titu->vpg}} {{$titu->vocal_propietario}}</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">@if($ae->asesor_externo != 'N') {{$titu->asesor_externo}} @else {{$titu->vsg}} {{$titu->vocal_suplente}} @endif</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">VOCAL PROPIETARIO</td>
                    <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td align="center" id="titulo">@if($ae->asesor_externo != 'N') VOCAL SUPLENTE & ASESOR @else VOCAL SUPLENTE @endif</td>
                  </tr>
                </tbody>
                </table>
            </div>
            <p id="cp">C.C.P. Alumno</p>
    </div>
    </div>
  </body>
</html>
