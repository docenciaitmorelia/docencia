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
      ->leftjoin('organigrama','users.clave_area','=','organigrama.clave_area')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Usuario = User::select('users.*','organigrama.descripcion_area')
      ->where('users.id','=',$id)
      ->leftjoin('organigrama','users.clave_area','=','organigrama.clave_area')
      ->first();
      $Areas = organigrama::select('clave_area','descripcion_area')->get();
      $Carreras = Carrera::select('carrera','nombre_reducido')
      ->where('nivel_escolar','L')->groupBy('carrera','nombre_reducido')->orderBy('nombre_reducido','asc')->get();
      $permisos = DB::table('permisos')->select('carrera')->where('usuario',$Usuario->name)->get();
      $Permisos = array();
      foreach($permisos as $p){
        array_push($Permisos,$p->carrera);
      }
      return view('auth.editar',['Usuario' => $Usuario,'Areas'=>$Areas, 'Carreras'=>$Carreras, 'Permisos'=>$Permisos]);
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
      DB::beginTransaction();
      DB::table('users')
          ->where('id', $id)
          ->update([
            'name' => $request->name,
            'rol' => $request->rol,
            'clave_area' => $request->clave_area,
            'password' => Hash::make($request->password),
          ]);
        DB::table('permisos')->where('usuario',$request->name)->delete();
        foreach($request->carreras as $carrera){
          DB::table('permisos')
          ->updateOrInsert(
            ['usuario' => $request->name,'carrera' => $carrera,'clave_area' => $request->clave_area]
          );
        }
        DB::commit();
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
