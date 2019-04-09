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
      return view('auth.register',['Areas' => $Areas,'Carreras' => $Carreras]);
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
