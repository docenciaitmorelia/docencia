<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Control de Propuesta</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
<body>
<div id="contenido">
	<p align="center">
		<strong>
			INSTITUTO TECNOLÓGICO DE MORELIA
			<br>
			SUBDIRECCIÓN ACADÉMICA
			<br>
			{{$seccion->descripcion_area}}
			<br>
			PROYECTO DOCENCIA
			<br>
			CONTROL DE PROPUESTA
		</strong>
	</p>
	<table>
		<tbody>
			<tr>
				<td width="30%">
					Título de propuesta:
				</td>
				<td style="border-bottom: 1px solid black;" width="70%">
					{{$titulacion->nombre_proyecto}}
				</td>
			</tr>
			<tr>
				<td>
					Opción de titulación:
				</td>
				<td style="border-bottom: 1px solid black;">
					{{$titulacion->nombre_opcion}}
				</td>
			</tr>
			<tr>
				<td>
					Nombre del solicitante:
				</td>
				<td style="border-bottom: 1px solid black;">
					{{$alumno->completo}}
				</td>
			</tr>
			<tr>
				<td>
					Pasante de la carrera:
				</td>
				<td style="border-bottom: 1px solid black;">
					{{$carrera->nombre}}
				</td>
			</tr>
			<tr>
				<td>
					Número de Control:
				</td>
				<td style="border-bottom: 1px solid black;">
					{{$alumno->no_de_control}}
				</td>
			</tr>
			<tr>
				<td>
					Nombre del asesor:
				</td>
				<td style="border-bottom: 1px solid black;">
					{{$titulacion->asesor}}
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<p>
		Revisores Asignados. Primera Revision
		<br>
		<br>
		<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
			<tr>
				<td rowspan="2" width="25%" align="center">
					<i>Revisor 1</i>
				</td>
				<td width="30%" align="center">
					Nombre
				</td>
				<td width="25%" align="center">
					Firma
				</td>
				<td width="20%" align="center">
					Fecha
				</td>
			</tr>
			<tr>
				<td height="40px" align="center">
					{{$titulacion->revisor1}}
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
		</table>
		<br>
		<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
			<tr>
				<td rowspan="2" width="25%" align="center">
					<i>Revisor 2</i>
				</td>
				<td width="30%" align="center">
					Nombre
				</td>
				<td width="25%" align="center">
					Firma
				</td>
				<td width="20%" align="center">
					Fecha
				</td>
			</tr>
			<tr>
				<td height="40px" align="center">
					{{$titulacion->revisor2}}
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
		</table>
		<br>
		<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
			<tr>
				<td rowspan="2" width="25%" align="center">
					<i>Revisor 3</i>
				</td>
				<td width="30%" align="center">
					Nombre
				</td>
				<td width="25%" align="center">
					Firma
				</td>
				<td width="20%" align="center">
					Fecha
				</td>
			</tr>
			<tr>
				<td height="40px" align="center">
					{{$titulacion->revisor3}}
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
		</table>
</p>
<p>
	Revisores Asignados. Segunda Revision
	<br>
	<br>
	<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
		<tr>
			<td rowspan="2" width="25%" align="center">
				<i>Revisor 1</i>
			</td>
			<td width="30%" align="center">
				Nombre
			</td>
			<td width="25%" align="center">
				Firma
			</td>
			<td width="20%" align="center">
				Fecha
			</td>
		</tr>
		<tr>
			<td align="center" height="40px">
				{{$titulacion->revisor1}}
			</td>
			<td>
				&nbsp;
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
	</table>
	<br>
	<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
		<tr>
			<td rowspan="2" width="25%" align="center">
				<i>Revisor 2</i>
			</td>
			<td width="30%" align="center">
				Nombre
			</td>
			<td width="25%" align="center">
				Firma
			</td>
			<td width="20%" align="center">
				Fecha
			</td>
		</tr>
		<tr>
			<td height="40px" align="center">
				{{$titulacion->revisor2}}
			</td>
			<td>
				&nbsp;
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
	</table>
	<br>
	<table border="1" bordercolor="black" align="center" width="100%" style="font-size: 9pt;">
		<tr>
			<td rowspan="2" width="25%" align="center">
				<i>Revisor 3</i>
			</td>
			<td width="30%" align="center">
				Nombre
			</td>
			<td width="25%" align="center">
				Firma
			</td>
			<td width="20%" align="center">
				Fecha
			</td>
		</tr>
		<tr>
			<td height="40px" align="center">
			{{$titulacion->revisor3}}
			</td>
			<td>
				&nbsp;
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
	</table>
</p>
</div>
</body>
</html>
