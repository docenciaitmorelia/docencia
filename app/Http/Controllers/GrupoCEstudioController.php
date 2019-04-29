<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoCEstudio;
use App\Alumno;
use App\Materia;
use App\Http\Requests\GrupoCEstudioRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GrupoCEstudioController extends Controller
{
    public function index(Request $request)
    {
        $grupocestudio= GrupoCEstudio::BG($request->busqueda)->orderBy('ciclo_escolar','ASC')->paginate();
        return view('grupocestudio.index',compact('grupocestudio'));
    }

    public function create()
    {
        $alumno=Alumno::select('no_de_control',DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))->orderBy('apellido_paterno')->get();
        $materia=Materia::where('nivel_escolar','L')->orderBy('nombre_completo_materia','ASC')->get();
    	return view('grupocestudio.create', compact('alumno','materia'));
    }

    public function store(GrupoCEstudioRequest $request)
    {
        $grupocestudio = new GrupoCEstudio;
    	  $grupocestudio->tutor  	        = $request->tutor;
    	  $grupocestudio->materia   	    = $request->materia;
    	  $grupocestudio->ciclo_escolar  	= $request->ciclo;
        $grupocestudio->dia1            = $request->dia1;
        $grupocestudio->hora1           = $request->hora1;
        $grupocestudio->salon1          = mb_strtoupper($request->salon1,'UTF-8');
        $grupocestudio->dia2            = $request->dia2;
        $grupocestudio->hora2           = $request->hora2;
        $grupocestudio->salon2          = mb_strtoupper($request->salon2,'UTF-8');

        $grupocestudio->save();

    	return redirect()->route('grupocestudio.index');
    					 #->with('info','El producto fue actualizado');
    }

    public function edit($id)
    {
        $grupo  = GrupoCEstudio::find($id);
        $alumno=DB::table('alumnos')->where('no_de_control',$grupo->tutor)
                ->first();
        $materia=Materia::where('nivel_escolar','L')->orderBy('nombre_completo_materia','ASC')->get();
        return view('grupocestudio.edit',compact('grupo','alumno','materia'));
    }

    public function update(grupoRequest $request, $id)
    {
        $grupocestudio = GrupoCEstudio::find($id);
        $grupocestudio->tutor  	        = $request->tutor;
    	  $grupocestudio->materia   	    = $request->materia;
    	  $grupocestudio->ciclo_escolar  	= $request->ciclo;
        $grupocestudio->dia1            = $request->dia1;
        $grupocestudio->hora1           = $request->hora1;
        $grupocestudio->salon1          = $request->salon1;
        $grupocestudio->dia2            = $request->dia2;
        $grupocestudio->hora2           = $request->hora2;
        $grupocestudio->salon2          = $request->salon2;

        $grupocestudio->save();
        return redirect()->route('grupocestudio.index');
    }

    public function listar_grupo($nc){
        $grupocestudio= GrupoCEstudio::select('grupo_cestudios.tutor as tutor','grupo_cestudios.id','materias.nombre_completo_materia','grupo_cestudios.dia1','grupo_cestudios.hora1','grupo_cestudios.salon1','grupo_cestudios.dia2','grupo_cestudios.hora2','grupo_cestudios.salon2')->join('alumnos','grupo_cestudios.tutor','=','alumnos.no_de_control')
                    ->join('materias','grupo_cestudios.materia', '=','materias.id')
                    ->where('grupo_cestudios.id','=',"$nc")
                    ->first();
        $alumno = Alumno::where('no_de_control',$grupocestudio->tutor)->get();
        //return $grupocestudio;
        return view('grupocestudio.fragment.listargrupo',compact('grupocestudio','alumno'));

    }

    public function gen_lista_c(){
        return view('grupocestudio.fragment.gen_lista_c');

    }

    public function gen_horario(){
        return view('grupocestudio.fragment.gen_horario');

    }
}
