<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titulacion;
use App\Alumno;
use App\Personal;
use App\OpcionesTitulacion;
use App\ProcesoTitulacion;
use App\Organigrama;
use App\Http\Requests\TitulacionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TitulacionController extends Controller
{
    public function index(Request $request)
    {
        $alumnos= Titulacion::BT($request->busqueda)->orderBy('estatus','ASC')->paginate();
        return view('titulaciones.index',compact('alumnos'));
    }

    public function create(Request $request)
    {
        //$alumno=Alumno::select('no_de_control',DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))->orderBy('apellido_paterno')->get();
        $alumnos=Alumno::AL($request->busqueda)->orderBy('apellido_paterno','asc')->get();
        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))
        ->where('clave_area','=',Auth::user()->clave_area)
        ->orderBy('apellidos_empleado')->get();
        $planes=OpcionesTitulacion::OT($alumnos)->get();
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
        $alumnos=Alumno::AL($request->busqueda)->orderBy('apellido_paterno','asc')->get();
        $personal=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->orderBy('apellidos_empleado')->get();
        $opcion=OpcionesTitulacion::OT($alumnos)->get();
        $planes=OpcionesTitulacion::OT($alumnos)->get();
        return view('titulaciones.edit', compact('titulacion','alumnos','personal','planes','opcion'));
    }

    public function update(TitulacionRequest $request, $id)
    {
        $titulacion = Titulacion::find($id);
        $titulacion->alumno        = $request->alumno;
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

    public function expediente_titulacion($nc,$estatus){
         $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"$estatus")
                        ->get();
        $alumno = Alumno::where('no_de_control','LIKE',"%$nc%")->get();
        $pro= Titulacion::select('proceso','opc_titu')->where('alumno', $nc)->where('estatus','=',"$estatus")->get();
        $p=$pro[0]->proceso;
        $opc=$pro[0]->opc_titu;
        $proceso = Titulacion::select('p.orden','p.descripcion','p.id')->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')->where('titulaciones.alumno','=',$nc)->where('titulaciones.estatus','=',$estatus)->get();
        if($p=='Alta'){
          $orden = 'Alta';

        }
        else {
          $ord = Titulacion::select('p.orden')
          ->join('proceso_titulacion as p','p.id_opcion','=','titulaciones.opc_titu')
          ->where('p.descripcion','=',$p)->get();
          $orden =$ord[0]->orden;
        }
        return view('titulaciones.fragment.expediente_titulacion',compact('titulacion','alumno','estatus','proceso','orden'));
    }

    private function obtener_siglas($estudios){
      $salutation="";
      if(stristr("maestr",$estudios)){
        $salutation = "M.";
      }
      if (stristr("doctor",$estudios)){
        $satutation = "D.";
      }
      if(stristr("ciencias",$estudios)){
        $salutation = $salutation . "C.";
      }
      if(stristr("ingenier",$estudios)){
        $salutation = "Ing.";
      }
      if(stristr("licenciad",$estudios)){
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
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();
        $alumno = Alumno::where('no_de_control','LIKE',"%$nc%")->get();

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
