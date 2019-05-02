<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Liberación de Proyecto</title>
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
          <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Liberación de Proyecto para Titulación Integral</td>
        </tr>
    </table>
    <br>
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
        Por este medio, le informo que ha sido liberado el siguiente proyecto para la Titulación Integral.
      </p>
      <table class="table table-bordered" bordercolor="black">
          <tbody>
              @foreach($data3 as $t)
            <tr>
              <td width="25%">Nombre del egresado (a):</td>
              <td>{{$t->completo}}</td>
            </tr>

            <tr>
              <td>Número de control</td>
              <td>{{$t->no_de_control}}</td>
            </tr>
            @endforeach
              @foreach($data2 as $t)
            <tr>
              <td>Carrera de:</td>
              <td>{{$t->nombre}}</td>
            </tr>
              @endforeach
            <tr>
              <td>Opción de Titulación</td>
              <td>{{$data->nombre_opcion}}</td>
            </tr>
            <tr>
              <td>Nombre del proyecto:</td>
              <td>"{{$data->nombre_proyecto}}"</td>
            </tr>
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
              <div class="col-md-12">
	              <table align="center">
	                <thead>
	                  <tr>
	                    <th width='30%'>&nbsp;</th>
	                    <th width='30%'>&nbsp;</th>
	                    <th width='30%'>&nbsp;</th>
	                  </tr>
	                </thead>
	                <tbody>
										<tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                  </tr>
	                  <tr>
	                    <td align="center">{{$seccion->jefe_area}}</td>
	                    <td align="center">&nbsp;</td>
	                    <td align="center">{{$academia->grado}} {{$academia->nombre_empleado}} {{$academia->apellidos_empleado}}</td>
	                  </tr>
	                  <tr>
	                    <td align="center" id="titulo">JEFE DEL {{$seccion->descripcion_area}}</td>
	                    <td align="center">&nbsp;</td>
	                    <td align="center" id="titulo">PRESIDENTE DE ACADEMIA</td>
	                  </tr>

										<tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                  </tr>

										<tr>
	                    <td>&nbsp;</td>
	                    <td align="center">{{$data->ag}} {{$data->asesor}}</td>
	                    <td>&nbsp;</td>
	                  </tr>
										<tr>
	                    <td>&nbsp;</td>
	                    <td align="center">ASESOR</td>
	                    <td>&nbsp;</td>
	                  </tr>
	                </tbody>
	                </table>
            </div>
  </div>
    </div>
  </body>
</html>
