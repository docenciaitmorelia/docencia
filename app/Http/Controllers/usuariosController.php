<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\organigrama;
use App\Carrera;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Usuarios = User::select('users.*','organigrama.descripcion_area')
      ->join('organigrama','users.clave_area','=','organigrama.clave_area')
      ->get();

      return view('auth.index',['Usuarios' => $Usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $Areas = organigrama::select('clave_area','descripcion_area')
      ->where('tipo_area','D')
      ->get();
      $Carreras = Carrera::select('carrera','reticula','nombre_reducido')->get();
      $Docentes = DB::table('personal')
      ->select('rfc','apellidos_empleado','nombre_empleado')
      ->where('clave_centro_seit','16DIT0012H')
      ->get();
      return view('auth.register',['Areas' => $Areas,'Carreras' => $Carreras,'Docentes'=>$Docentes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Usuario = User::select('users.*','organigrama.descripcion_area','users.carrera','carreras.nombre_reducido')
      ->where('users.id','=',$id)
      ->join('organigrama','users.clave_area','=','organigrama.clave_area')
      ->join('carreras','users.carrera','=','carreras.carrera')
      ->get();
      $Areas = organigrama::select('clave_area','descripcion_area')->get();
      $Carreras = Carrera::select('carrera','reticula','nombre_reducido')->get();
      return view('auth.editar',['Usuario' => $Usuario[0],'Areas'=>$Areas, 'Carreras'=>$Carreras]);
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
      DB::table('users')
          ->where('id', $id)
          ->update([
            'name' => $request->name,
            'rol' => $request->rol,
            'clave_area' => $request->clave_area,
            'carrera' => $request->carrera,
            'password' => Hash::make($request->password),
          ]);

      return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        DB::table('users')->where('id', $id)->delete();
      } catch(Exception $e) {
        abort(403, 'La acción que intenta realizar no está permitida debido a que es indispensable para el sistema.');
      }

      return redirect()->route('admin');
    }
}
