<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titulacion;
use App\Alumno;
use App\Personal;
use App\OpcionesTitulacion;
use App\ProcesoTitulacion;
use App\Organigrama;
use App\Revision;
use App\Http\Requests\TitulacionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TitulacionController extends Controller
{
    public function index(Request $request)
    {
        $alumnos= Titulacion::BT2($request->busqueda)->orderBy('estatus','ASC')->paginate();
        return view('titulaciones.index',compact('alumnos'));
    }

    public function create(Request $request)
    {
        $alumnos=Alumno::AL($request->busqueda)
                ->orderBy('apellido_paterno','asc')
                ->orderBy('apellido_materno','asc')
                ->orderBy('nombre_alumno','asc')
                ->get();

        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))
                ->where('area_academica','=',Auth::user()->clave_area)
                ->orderBy('apellidos_empleado')->get();
        $planes=OpcionesTitulacion::OT($alumnos)->get();
        //return $alumnos;
      return view('titulaciones.create', compact('alumnos','personal','planes'));
    }

    public function store(TitulacionRequest $request)
    {
        $titulacion = new Titulacion;
        $titulacion->alumno             = $request->alumno;
        $titulacion->nombre_proyecto    = mb_strtoupper($request->proyecto,'UTF-8');
        $titulacion->opc_titu           = $request->opc_titu;
        $titulacion->asesor             = $request->asesor;
        $titulacion->presidente         = $request->presidente;
        $titulacion->secretario         = $request->secretario;
        $titulacion->vocal_propietario  = $request->vocal_propietario;
        $titulacion->vocal_suplente     = $request->vocal_suplente;
        $titulacion->estatus            = "ACTIVO";
        $titulacion->proceso            = "Alta";
        $titulacion->fecha_cer          = "";
        $titulacion->lugar              = "";
        $titulacion->hora               = "";

        $titulacion->save();

        return redirect()->route('titulaciones.index');
    }

    public function edit(Request $request,$id)
    {
        $titulacion  = Titulacion::find($id);
        //$alumno=Alumno::select('no_de_control',DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))->orderBy('apellido_paterno')->get();
        $alumno=DB::table('alumnos')->where('no_de_control',$titulacion->alumno)
                ->first();
        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))
        ->where('area_academica','=',Auth::user()->clave_area)
        ->orderBy('apellidos_empleado')->get();
        $opcion=OpcionesTitulacion::OT($alumno)->get();
        $planes=OpcionesTitulacion::OT($alumno)->get();
        return view('titulaciones.edit', compact('titulacion','alumno','personal','planes','opcion'));
    }

    public function update(TitulacionRequest $request, $id)
    {
        $titulacion = Titulacion::find($id);
        //$titulacion->alumno        = $request->alumno;
        $titulacion->nombre_proyecto      = mb_strtoupper($request->proyecto,'UTF-8');
        $titulacion->opc_titu      = $request->opc_titu;
        $titulacion->asesor        = $request->asesor;
        $titulacion->presidente      = $request->presidente;
        $titulacion->secretario      = $request->secretario;
        $titulacion->vocal_propietario      = $request->vocal_propietario;
        $titulacion->vocal_suplente      = $request->vocal_suplente;
        $titulacion->estatus       = $request->estatus;
        $titulacion->fecha_cer     = "";
        $titulacion->lugar         = "";
        $titulacion->hora          = "";

        $titulacion->save();
        return redirect()->route('titulaciones.index');
    }

    public function expediente_titulacion($nc){
        $titulacion=Titulacion::select('a.estudios as estudios_asesor','titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion')
                  ->join('personal as a','a.rfc','=','titulaciones.asesor')
                  ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                  ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                  ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                  ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                  ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                  ->where('titulaciones.id',$nc)
                  ->first();
        $alumno = Alumno::where('no_de_control','=',"$titulacion->alumno")->first();
        $pro= Titulacion::select('proceso','opc_titu')->where('id', $nc)->first();
        $p=$pro->proceso;
        $opc=$pro->opc_titu;
        $proceso = Titulacion::select('p.orden','p.descripcion','p.id')->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')->where('titulaciones.id','=',$nc)->get();
        $propuesta = Revision::select('veredicto')->where('id_titulacion','=',"$titulacion->id")->where('tipo_revision','=','Propuesta')->get();
        $ordenL = Titulacion::select('p.orden')->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')->where('titulaciones.id','=',$nc)->where('descripcion','=',"Liberación de Proyecto")->get();
        $aprobacion = Revision::select(DB::raw('count(*) as total'))->where('veredicto','APROBADO')->where('id_titulacion','=',"$titulacion->id")->where('tipo_revision','=','PROPUESTA')->first();
        if(count($propuesta) > 0){
          if($aprobacion->total == 4){
            $v=1;
          }
          else{
            $v=0;
          }
        }
        else{
          $v=0;
        }
        if(count($ordenL) > 0){
          $ol= $ordenL[0]->orden;
        }
        else {
          $ol=0;
        }
        $borrador = Revision::select(DB::raw('count(*) as total'))->where('veredicto','APROBADO')->where('id_titulacion','=',"$titulacion->id")->where('tipo_revision','=','PROYECTO')->first();
        $ordenI = Titulacion::select('p.orden')->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')->where('titulaciones.id','=',$nc)->where('descripcion','=',"Impresión Definitiva")->get();
        if($borrador->total == 4){
          $b = 'A';
        }
        else{
          $b= 'N';
        }
        if(count($ordenI) > 0){
          $oi= $ordenI[0]->orden;
        }
        else {
          $oi=0;

        }
        if($p=='Alta'){
          $orden = 'Alta';

        }
        else {
          $ord = Titulacion::select('p.orden')
          ->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')
          ->where('p.descripcion','=',$p)->first();
          $orden =$ord->orden;
        }
        //return $titulacion->nombre_opcion;
        return view('titulaciones.fragment.expediente_titulacion',compact('titulacion','alumno','proceso','orden','b','ol','v','oi'));
    }

    private function obtener_siglas($estudios){
      $salutation="";
      $estudios = strtoupper($estudios);
      if(stristr($estudios,"MAESTR")){
        $salutation = "M.";
      }
      if (stristr($estudios,"DOCTOR")){
        $satutation = "D.";
      }
      if(stristr($estudios,"CIENCIAS")){
        $salutation = $salutation . "C.";
      }
      if(stristr($estudios,"INGENIER")){
        $salutation = "Ing.";
      }
      if(stristr($estudios,"LICENCIAD")){
        $salutation = "Lic.";
      }
      return $salutation;
    }

    public function proyectosDocentes(Request $request){

    }

    public function autorizarProyecto(){

    }

    public function autorizarLiberacionProyecto(){

    }
    public function gen_documentos(Request $request,$nc){
      $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion')
                ->join('personal as a','a.rfc','=','titulaciones.asesor')
                ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                ->where('titulaciones.id',$nc)
                ->first();
      $alumno = Alumno::where('no_de_control','=',"$titulacion->alumno")->first();

        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->where('nombramiento','=','D')->orderBy('apellidos_empleado')->get();

        if ($request->documento == 'Registro de Opción de Titulación'){
          return $this->gen_registro($titulacion,$alumno,$nc);
        }
        if ($request->documento == "Asignación de Sinodales") {
            return $this->gen_asignacion_s($titulacion,$alumno,$nc,$personal);
        }

        if ($request->documento == "Impresión Definitiva") {
            return $this->gen_impresion_d($titulacion,$alumno,$nc);
        }

        if ($request->documento == "Asignación de Revisores") {
            return $this->gen_asignacion_r($titulacion,$alumno,$nc,$personal);
        }

        if ($request->documento == "Liberación de Proyecto") {
            return $this->gen_liberacion_p($titulacion,$alumno,$nc,$personal);
        }

        if($request->documento == "Invitación a Ceremonia de Titulación"){
          return $this->gen_invitacion($titulacion,$alumno,$nc);
        }

    }

    public function gen_registro($titulacion,$alumno,$nc){
        return view('titulaciones.fragment.gen_registro',compact('titulacion','alumno'));

    }

    public function gen_asignacion_s($titulacion,$alumno,$nc,$personal){
        return view('titulaciones.fragment.gen_asignacion_s',compact('titulacion','alumno','personal'));

    }

    public function gen_impresion_d($titulacion,$alumno,$nc){
        return view('titulaciones.fragment.gen_impresion_d',compact('titulacion','alumno'));

    }

    public function gen_asignacion_r($titulacion,$alumno,$nc,$personal){
        return view('titulaciones.fragment.gen_asignacion_r',compact('titulacion','alumno','personal'));

    }

    public function gen_liberacion_p($titulacion,$alumno,$nc,$personal){
        return view('titulaciones.fragment.gen_liberacion_p',compact('titulacion','alumno','personal'));

    }

    public function gen_invitacion($titulacion,$alumno,$nc){
        return view('titulaciones.fragment.gen_invitacion',compact('titulacion','alumno'));

    }

    public function gen_reporte_a(){
        return view('titulaciones.fragment.gen_reporte_a');
    }

    public function gen_reporte_d(){
        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->orderBy('apellidos_empleado')->get();
        return view('titulaciones.fragment.gen_reporte_d',compact('personal'));
    }
}
