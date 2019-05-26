<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titulacion;
use App\Alumno;
use App\Revision;
use Illuminate\Support\Facades\DB;


class proyectoTitulacionController extends Controller
{
    public function index(Request $request)
    {
      $alumnos= Titulacion::BT($request->busqueda)
      ->select('no_de_control','apellido_paterno','apellido_materno','nombre_alumno','nombre_proyecto','id')
      ->orderBy('nombre_proyecto','ASC')->paginate();
      return view('titulaciones.proyecto.index',compact('alumnos'));
    }

    public function store(Request $request)
    {
      $registro = DB::table('revisiones')->select(DB::raw('count(*) as revisor_count'),'id')
      ->where('id_titulacion',$request->id_titulacion)
      ->where('revisor',$request->revisor)
      ->where('tipo_revision',$request->tipo_revision)
      ->groupBy('id')
      ->first();
      $revision = '';
      if(isset($registro->revisor_count) && $registro->revisor_count >= 1){
        $revision = Revision::find($registro->id);
      } else {
        $revision = new Revision;
      }
      $hoy=getdate();
      $fecha_revision = $hoy['year']."/".$hoy['mon']."/".$hoy['mday'];
      $revision->id_titulacion = $request->id_titulacion;
      $revision->revisor = $request->revisor;
      $revision->tipo_revision = $request->tipo_revision;
      $revision->fecha_revision = $fecha_revision;
      $revision->veredicto = $request->veredicto;
      $revision->comentarios = $request->comentarios;
      $revision->save();

      return redirect()->route('proyectoTitulacionCtl.index');

    }

    public function show($nc)
    {
      $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
      if($ae->asesor_externo == 'N'){
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno as alumno','titulaciones.id','titulaciones.nombre_proyecto','s1.rfc as rfc_revisor1','s2.rfc as rfc_revisor2','s3.rfc as rfc_revisor3',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS revisor1"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS revisor2"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS revisor3"),'op.nombre_opcion as nombre_opcion')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.revisor1')
                 ->join('personal as s2','s2.rfc','=','titulaciones.revisor2')
                 ->join('personal as s3','s3.rfc','=','titulaciones.revisor3')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->where('titulaciones.id',$nc)
                 ->first();
      }
      else{
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno as alumno','titulaciones.id','titulaciones.nombre_proyecto','s1.rfc as rfc_revisor1','s2.rfc as rfc_revisor2','s3.rfc as rfc_revisor3',DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS revisor1"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS revisor2"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS revisor3") ,'titulaciones.asesor_externo as asesor','op.nombre_opcion as nombre_opcion')
                 ->join('personal as s1','s1.rfc','=','titulaciones.revisor1')
                 ->join('personal as s2','s2.rfc','=','titulaciones.revisor2')
                 ->join('personal as s3','s3.rfc','=','titulaciones.revisor3')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->where('titulaciones.id',$nc)
                 ->first();

    }
     $revisiones=DB::table('revisiones')->where('revisiones.id_titulacion',$titulacion->id)->get();
     $alumno = Alumno::where('no_de_control','=',$titulacion->alumno)->first();
     return view('titulaciones.proyecto.expediente',compact('titulacion','alumno','revisiones'));
    }

    public function showRevisiones($nc)
    {
      $ae=Titulacion::select('asesor_externo','id')->where('alumno',$nc)->where('estatus','ACTIVO')->first();
      if($ae && $ae->asesor_externo == 'N'){
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno as alumno','titulaciones.id','titulaciones.nombre_proyecto','s1.rfc as rfc_revisor1','s2.rfc as rfc_revisor2','s3.rfc as rfc_revisor3',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS revisor1"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS revisor2"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS revisor3"),'op.nombre_opcion as nombre_opcion')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.revisor1')
                 ->join('personal as s2','s2.rfc','=','titulaciones.revisor2')
                 ->join('personal as s3','s3.rfc','=','titulaciones.revisor3')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->where('titulaciones.id',$ae->id)
                 ->first();
        //
        $revisiones=DB::table('revisiones')->where('revisiones.id_titulacion',$titulacion->id)->get();
        $alumno = Alumno::where('no_de_control','=',$titulacion->alumno)->first();
      }
      elseif ($ae && $ae->asesor_externo != 'N'){
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno as alumno','titulaciones.id','titulaciones.nombre_proyecto','s1.rfc as rfc_revisor1','s2.rfc as rfc_revisor2','s3.rfc as rfc_revisor3',DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS revisor1"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS revisor2"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS revisor3") ,'titulaciones.asesor_externo as asesor','op.nombre_opcion as nombre_opcion')
                 ->join('personal as s1','s1.rfc','=','titulaciones.revisor1')
                 ->join('personal as s2','s2.rfc','=','titulaciones.revisor2')
                 ->join('personal as s3','s3.rfc','=','titulaciones.revisor3')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->where('titulaciones.id',$ae->id)
                 ->first();
        //
        $revisiones=DB::table('revisiones')->where('revisiones.id_titulacion',$titulacion->id)->get();


    }
    else{
      $titulacion = "N";
      $revisiones = "N";
    }
    $alumno = Alumno::where('no_de_control','=',$nc)->first();
     //return $revisiones;
     return view('titulaciones.proyecto.expediente_docencia',compact('titulacion','alumno','revisiones'));
    }

}
