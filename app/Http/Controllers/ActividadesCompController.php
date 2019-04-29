<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadesComp;
use App\Alumno;
use App\Personal;
use App\CatalogoAC;
use App\Http\Requests\ActividadesCompRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActividadesCompController extends Controller
{
    public function index(Request $request)
    {
        $actividades= ActividadesComp::AC($request->busqueda)->orderBy('actividad','ASC')->paginate();
        return view('actividadescomp.index',compact('actividades'));
    }

    public function create(Request $request)
    {
      $alumnos=Alumno::ALAC()->filtrar($request->busqueda)
              ->orderBy('apellido_paterno','asc')
              ->orderBy('apellido_materno','asc')
              ->orderBy('nombre_alumno','asc')
              ->get();
        $docente=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->orderBy('apellidos_empleado')->get();
        $tipo=CatalogoAC::select('id','actividad')->orderBy('actividad')->get();
    	return view('actividadescomp.create', compact('alumnos','docente','tipo'));
    }

    public function store(actividadescompRequest $request)
    {
    	$actividadescomp = new ActividadesComp;
    	$actividadescomp->alumno  	   	= $request->alumno;
        $actividadescomp->tipo          = $request->tipo;
    	$actividadescomp->actividad  	= mb_strtoupper($request->actividad,'UTF-8');
    	$actividadescomp->creditos   	= $request->creditos;
    	$actividadescomp->fecha_del  	= $request->fecha_del;
        $actividadescomp->fecha_al   	= $request->fecha_al;
    	$actividadescomp->horas      	= $request->horas;
    	$actividadescomp->calificacion	= $request->calificacion;
    	$actividadescomp->docente_resp	= $request->docente_resp;

        $actividadescomp->save();

    	return redirect()->route('actividadescomp.index');
    					 #->with('info','La actividad fue registrada');
    }

    public function edit($id)
    {
        $actividadescomp  = ActividadesComp::find($id);
        $alumno=DB::table('alumnos')->where('no_de_control',$actividadescomp->alumno)
                ->first();
        $docente=Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->orderBy('apellidos_empleado')->get();
        $tipo=CatalogoAC::select('id','actividad')->orderBy('actividad')->get();
        return view('actividadescomp.edit', compact('actividadescomp','alumno','docente','tipo'));
    }

    public function update(ActividadesCompRequest $request, $id)
    {
        $actividadescomp = ActividadesComp::find($id);
        $actividadescomp->tipo          = $request->tipo;
        $actividadescomp->actividad     = mb_strtoupper($request->actividad,'UTF-8');
    	  $actividadescomp->creditos   	= $request->creditos;
    	  $actividadescomp->fecha_del  	= $request->fecha_del;
        $actividadescomp->fecha_al   	= $request->fecha_al;
    	  $actividadescomp->horas      	= $request->horas;
    	  $actividadescomp->calificacion	= $request->calificacion;
    	  $actividadescomp->docente_resp	= $request->docente_resp;

        $actividadescomp->save();
        return redirect()->route('actividadescomp.index');
                        #->with('info','La actividad fue editada');
    }

    public function listar_ac($nc){
        $actividadescomp  = ActividadesComp::where('alumno','=',"$nc")->orderBy('id','ASC')->get();
        $alumno = Alumno::where('no_de_control','=',"$nc")->get();
        $docente = Personal::select('rfc',DB::raw("CONCAT(apellidos_empleado,' ',nombre_empleado) AS completo"))->orderBy('apellidos_empleado')->get();
        $ncreditos=actividadescomp::where('alumno','=',"$nc")
                        ->sum('creditos');
        //return $actividadescomp;
        return view('actividadescomp.fragment.listarac',compact('actividadescomp','alumno','docente','ncreditos'));

    }
}
