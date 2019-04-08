<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Constancia de Círculo de Estudios</title>
  <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">

</head>
  <body>
    <div id="contenido">
    <table align="right">
        <tr>
          <td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>SISTEMAS Y COMPUTACIÓN</td>
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
          <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Constancia de asesoría de círculos de estudios</td>
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
          A quién corresponda:
        </strong>
      </p>
      <br>
      <br>
      <p align="justify">
        Por medio de la presente se hace <strong>CONSTAR</strong> que el <strong>C. @foreach($data as $alumno) {{$alumno->completo}}&nbsp; @endforeach</strong> de la carrera @foreach($data4 as $carrera) {{$carrera->nombre}}, @endforeach &nbsp;con número de control {{$nc}}, apoyó como ASESOR(A) de Círculos de estudio en la(s) materia(s) @foreach($data2 as $materia) {{$materia->nombre}}, @endforeach &nbsp;en el periodo @foreach($data3 as $ciclo) @if($ciclo->ciclo_escolar==1) ENERO-JUNIO @else AGOSTO-DICIEMBRE @endif @endforeach{{$anio}}.
      </p>
        
     <br>

      <p align="justify">
        Se expide la presente para los fines que al interesado convengan, y sin otro particular, le envío un cordial saludo.
      </p>
      <br>
      <br>
      <br>
      <br>
      <div id="firmas">
            <p align="center"><strong>ATENTAMENTE</strong><br>
              <i id="tec">"Técnica, progreso de México"</i>
            </p>
            <br>
            <br>
            <br>
            <div class="col-md-12">
              <table align="center">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">@foreach($data5 as $docente) {{ $docente->especializacion}} @endforeach @foreach($data5 as $docente) {{ $docente->completo}} @endforeach</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">@foreach($data5 as $docente) @if($docente->sexo=='M')Jefe @else Jefa @endif @endforeach del Departamento de Sistemas y Computación</td>
                  </tr>
                </tbody>
                </table>
            </div>
            <p id="cp">Cp. Archivo</p>
    </div>
    </div>
      </div>
  </body>
</html>