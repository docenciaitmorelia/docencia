<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titulacion;
use App\Alumno;
use App\Revision;
use Illuminate\Support\Facades\DB;


class proyectoTitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $alumnos= Titulacion::BT($request->busqueda)
      ->select('no_de_control','apellido_paterno','apellido_materno','nombre_alumno','nombre_proyecto')
      ->orderBy('nombre_proyecto','ASC')->paginate();
      return view('titulaciones.proyecto.index',compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nc)
    {
      $titulacion= Titulacion::select('a.rfc as rfc_asesor','s1.rfc as rfc_presidente','s2.rfc as rfc_secretario','s3.rfc as rfc_vocal_propietario','s4.rfc as rfc_vocal_suplente','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion')
                     ->join('personal as a','a.rfc','=','titulaciones.asesor')
                     ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                     ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                     ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                     ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                     ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                     ->where('titulaciones.alumno','=',$nc)
                     ->first();
     $revisiones=DB::table('revisiones')->where('revisiones.id_titulacion',$titulacion->id)->get();
     $alumno = Alumno::where('no_de_control','=',$nc)->first();
     return view('titulaciones.proyecto.expediente',compact('titulacion','alumno','revisiones'));
    }

    public function showRevisiones($nc)
    {
      $titulacion= Titulacion::select('a.rfc as rfc_asesor','s1.rfc as rfc_presidente','s2.rfc as rfc_secretario','s3.rfc as rfc_vocal_propietario','s4.rfc as rfc_vocal_suplente','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion')
                     ->join('personal as a','a.rfc','=','titulaciones.asesor')
                     ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                     ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                     ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                     ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                     ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                     ->where('titulaciones.alumno','=',$nc)
                     ->first();
     $revisiones=DB::table('revisiones')->where('revisiones.id_titulacion',$titulacion->id)->get();
     $alumno = Alumno::where('no_de_control','=',$nc)->first();
     return view('titulaciones.proyecto.expediente_docencia',compact('titulacion','alumno','revisiones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
