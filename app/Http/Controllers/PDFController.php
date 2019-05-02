<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadesComp;
use App\Alumno;
use App\Personal;
use App\Carrera;
use App\Jefe;
use App\GrupoCEstudio;
use App\OpcionesTitulacion;
use App\Titulacion;
use App\ProcesoTitulacion;
use App\Puesto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use File;

class PDFController extends Controller
{

    //ACTIVIDADES COMPLEMENTARIAS

    public function crearPDFAC($datos,$datos2,$datos3,$vistaurl,$nc,$carrera,$jefedsc,$gjdsc,$doc,$jefeesc,$gjesc,$nof,$docencia){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $datos;
        $data2  = $datos2;
        $data3  = $datos3;
        $data4  = $carrera;
        $data5  = $jefedsc;
        $gjdsc  = $gjdsc;
        $gjesc  = $gjesc;
        $data6  = $doc;
        $data7  = $jefeesc;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'date','data2','data3','date','nc','data4','data5','data6','data7','nof','gjesc','gjdsc','docencia'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view,[],$overwrite = true)->save('pdf/AC/'.$nc.'.pdf');
        return $pdf->stream(''.$nc.'.pdf');
    }

    public function crear_constancia_ac(Request $request,$nc){
        $input = $request->input('oficio');
        $controller = new ActividadesCompController;
        if (file_exists('pdf/AC/'.$nc.'.pdf')){
            File::delete('pdf/AC/'.$nc.'.pdf');
        }
            $vistaurl="pdfs.constancia_ac";
            $ac=ActividadesComp::select('actividad','creditos','fecha_del','fecha_al','calificacion')
                        ->where('alumno','=',"$nc")->orderBy('fecha_del','ASC')->orderBy('fecha_al','ASC')->get();
            $nomb=DB::table('alumnos')->where('no_de_control','=',"$nc")->get();
            $sum=ActividadesComp::where('alumno','=',"$nc")
                        ->sum(DB::raw('calificacion * creditos'));
            $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                                            ->where('alumnos.no_de_control','=',"$nc")->groupBy('nombre')->get();

            $prom=(double)$sum/5;
            $jefedsc    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
            $gjdsc      = Personal::select('sexo_empleado')->where('rfc','=',"$jefedsc->rfc")->get();
            //Auth::user()->name
            $doc=Personal::select(DB::raw("CONCAT(nombre_empleado,' ',apellidos_empleado) AS completo"),'sexo_empleado AS sexo')->where('personal.rfc','=','AOHA640415K52')->get();
            $jefeesc    = Jefe::where('clave_area','=','120600')->first();
            $gjesc      = Personal::select('sexo_empleado')->where('rfc','=',"$jefeesc->rfc")->get();
            $docencia   =Puesto::select('g.grado as grado','d.apellidos_empleado','d.nombre_empleado','d.sexo_empleado as sexo_empleado')->join('grados as g','g.rfc','=','puesto_d.rfc')->join('personal as d','d.rfc','=','puesto_d.rfc')->where('puesto_d.puesto','JEFE DOCENCIA')->where('puesto_d.clave_area','=',Auth::user()->clave_area)->first();
            //return $doc;
            return $this->crearPDFAC($ac,$nomb,$prom, $vistaurl,$nc,$c,$jefedsc,$gjdsc,$doc,$jefeesc,$gjesc,$input,$docencia);
    }

    //CIRCULOS DE ESTUDIOS

    public function crearPDFCE($alumno,$materia,$ciclo,$vistaurl,$carrera,$jefedsc,$gjdsc,$nc,$nof){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $alumno;
        $data2  = $materia;
        $data3  = $ciclo;
        $data4  = $carrera;
        $data5  = $jefedsc;
        $gjdsc  = $gjdsc;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y');
        $anio   = date('Y');
        $view   = \View::make($vistaurl, compact('data', 'date','data2','data3','data4','data5','nc','nof','anio','gjdsc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/Circulos/'.$data->no_de_control.'.pdf');
        //return $nc;
        return $pdf->stream(''.$nc.'.pdf');
    }

    public function crear_constancia_ce(Request $request,$nc){
        $input = $request->input('oficio');
            $vistaurl="pdfs.constancia_ce";
            $alumno=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','=',"$nc")->first();
            if (file_exists('pdf/Circulos/'.$alumno->no_de_control.'.pdf')){
                File::delete('pdf/Circulos/'.$alumno->no_de_control.'.pdf');
            }
            $materia=GrupoCEstudio::select('materias.nombre_completo_materia as nombre')->join('materias','grupo_cestudios.materia','=','materias.id')
                            ->where('grupo_cestudios.tutor','=',"$nc")->get();

            $carrera=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                            ->where('alumnos.no_de_control','=',"$nc")->groupBy('nombre')->get();

            $ciclo=GrupoCEstudio::select('ciclo_escolar')->where('grupo_cestudios.tutor','LIKE',"%$nc%")->get();

            $jefedsc    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
            $gjdsc      = Personal::select('sexo_empleado')->where('rfc','=',"$jefedsc->rfc")->get();
            //return $nc;
            return $this->crearPDFCE($alumno,$materia,$ciclo,$vistaurl,$carrera,$jefedsc,$gjdsc,$nc,$input);

    }

    public function crear_lista_circulos(Request $request){
        $periodo = $request->semestre;
        $anio=Carbon::now()->year;

        $vistaurl="pdfs.lista_c";
        if($periodo == 'E-J'){
            $alumno=GrupoCEstudio::select(DB::raw("CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno) AS completo"))
                        ->join('alumnos as a','a.no_de_control','=','grupo_cestudios.tutor')
                        ->whereBetween('grupo_cestudios.created_at', [$anio."-01-01", $anio."-06-30"])
                        ->get();
        }
        else{
            $alumno=GrupoCEstudio::select(DB::raw("CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno) AS completo"))
                        ->join('alumnos as a','a.no_de_control','=','grupo_cestudios.tutor')
                        ->whereBetween('grupo_cestudios.created_at', [$anio."-08-01", $anio."-12-31"])
                        ->get();
        }
        //return $alumno;
        return $this->crearPDFLC($alumno,$vistaurl,$periodo,$anio);
    }

    public function crearPDFLC($alumno,$vistaurl,$periodo,$anio){
        $alu=$alumno;
        $view   = \View::make($vistaurl, compact('alu','periodo', 'anio'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Horario-'.$periodo.' '.$anio.'.pdf');
    }

    public function crear_horario(Request $request){
        $periodo = $request->semestre;
        $anio=Carbon::now()->year;

        $vistaurl="pdfs.horario";
        if($periodo == 'E-J'){
            $horario=GrupoCEstudio::select(DB::raw("CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno) AS completo"),'m.nombre_completo_materia as materia','dia1','hora1','salon1','dia2','hora2','salon2')
                        ->join('alumnos as a','a.no_de_control','=','grupo_cestudios.tutor')
                        ->join('materias as m','m.id','=','grupo_cestudios.materia')
                        ->whereBetween('grupo_cestudios.created_at', [$anio."-01-01", $anio."-06-30"])
                        ->get();
        }
        else{
            $horario=GrupoCEstudio::select(DB::raw("CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno) AS completo"),'m.nombre_completo_materia as materia','dia1','hora1','salon1','dia2','hora2','salon2')
                        ->join('alumnos as a','a.no_de_control','=','grupo_cestudios.tutor')
                        ->join('materias as m','a.id','=','grupo_cestudios.materia')
                        ->whereBetween('grupo_cestudios.created_at', [$anio."-01-01", $anio."-06-30"])
                        ->get();
        }
        return $this->crearPDFH($horario,$vistaurl,$periodo,$anio);
    }

    public function crearPDFH($horario,$vistaurl,$periodo,$anio){
        $hor=$horario;
        $view   = \View::make($vistaurl, compact('hor','periodo', 'anio'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Horario-'.$periodo.' '.$anio.'.pdf');
    }

    //TITULACIONES - DOCUMENTOS

    public function crear_asignacion_s(Request $request,$nc){
        $oficio = $request->input('oficio');
        $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
        if($ae->asesor_externo != 'N'){
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        else{
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        if (file_exists('pdf/AsignacionS/Asignacion_Sinodales_'.$titulacion->alumno.'.pdf')){
            File::delete('pdf/AsignacionS/Asignacion_Sinodales_'.$titulacion->alumno.'.pdf');
        }
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','no_de_control','reticula')
                                 ->where('no_de_control','=',"$titulacion->alumno")->first();

        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                  ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->first();
        $desc=$titulacion->detalle_opcion;
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->first();
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc',$jefediv->rfc)->first();
        if($desc=='Protocolario'){
          $vistaurl="pdfs.asignacion_sp";
        }
        else{
          $vistaurl="pdfs.asignacion_s";
        }
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Asignación de Sinodales'));
        $jefedsc    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
        $gjdsc      = Personal::select('sexo_empleado')->where('rfc','=',"$jefedsc->rfc")->get();
        //return $ae;
        return $this->crearPDFAS($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$ae,$jefedsc,$gjdsc);

    }

    public function crearPDFAS($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$ae,$jefedsc,$gjdsc){
        $titu   = $titulacion;
        $carrera  = $c;
        $alumno  = $nomb;
        $nof    = $oficio;
        $jefediv=$jefediv;
        $gjdiv  =$gjdiv;
        $gjdsc  = $gjdsc;
        $jefedsc  = $jefedsc;
        $meses  = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu', 'carrera','alumno','date','nof','nc','jefediv','gjdiv','ae','jefedsc','gjdsc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        //$pdf    ->loadHTML($view)->save('pdf/AsignacionS/Asignacion_Sinodales_'.$nc.'.pdf');
        $pdf    ->loadHTML($view)->save('pdf/AsignacionS/Asignacion_Sinodales_'.$titu->alumno.'.pdf');
        //$pdf    ->loadHTML($view);
        return $pdf->stream('Asignacion_Sinodales_'.$titu->alumno.'.pdf');
    }

    public function crear_impresion_d(Request $request,$nc){
        $oficio     = $request->input('oficio');
        $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
        if($ae->asesor_externo != 'N'){
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        else{
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        if (file_exists('pdf/Impresion_Definitiva/Impresion_Definitiva_'.$titulacion->alumno.'.pdf')){
            File::delete('pdf/Impresion_Definitiva/Impresion_Definitiva_'.$titulacion->alumno.'.pdf');
        }
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'reticula','sexo','no_de_control')
                      ->where('no_de_control',$titulacion->alumno)->first();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                    ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->first();

        $ret        = $nomb->reticula;
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->first();
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc',$jefediv->rfc)->first();
        $seccion    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
        if($ret < 2010){
          $vistaurl   = "pdfs.impresion_d";
        }
        else{
          $vistaurl   = "pdfs.impresion_dti";
        }
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Asignación de Sinodales'));
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Impresión Definitiva'));
        return $this->crearPDFID($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$ae,$seccion);
    }

    public function crearPDFID($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$ae,$seccion){
        $titu   = $titulacion;
        $carrera  = $c;
        $alumno  = $nomb;
        $nof  = $oficio;
        $jefediv=$jefediv;
        $gjdiv  =$gjdiv;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dia = array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        $date   = $dia[date('w')]." ".date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu', 'carrera','alumno','date','nof','nc','jefediv','gjdiv','ae','seccion'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/Impresion_Definitiva/Impresion_Definitiva_'.$titu->alumno.'.pdf');
        return $pdf->stream('Impresion_Definitiva_'.$titu->alumno.'.pdf');
    }

    public function crear_asignacion_r(Request $request,$nc){
      $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
      if($ae->asesor_externo != 'N'){
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
               ->join('personal as a','a.rfc','=','titulaciones.asesor')
               ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
               ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
               ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
               ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
               ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
               ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
               ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
               ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
               ->where('titulaciones.id',$nc)
               ->first();
      }
      else{
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
               ->join('personal as a','a.rfc','=','titulaciones.asesor')
               ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
               ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
               ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
               ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
               ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
               ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
               ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
               ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
               ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
               ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
               ->where('titulaciones.id',$nc)
               ->first();
      }
      if (file_exists('pdf/AsignacionR/Asignacion_Revisores_'.$titulacion->alumno.'.pdf')){
          File::delete('pdf/AsignacionR/Asignacion_Revisores_'.$titulacion->alumno.'.pdf');
      }
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','reticula','no_de_control')
                               ->where('no_de_control','=',"$titulacion->alumno")->first();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                        ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->get();
        $seccion    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
        $academia   =Puesto::select('g.grado as grado','d.apellidos_empleado','d.nombre_empleado')->join('grados as g','g.rfc','=','puesto_d.rfc')->join('personal as d','d.rfc','=','puesto_d.rfc')->where('puesto_d.puesto','PRESIDENTE ACADEMIA')->where('puesto_d.clave_area','=',Auth::user()->clave_area)->first();
        $vistaurl="pdfs.asignacion_r";
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Asignación de Revisores'));
        //return $nomb;
        return $this->crearPDFAR($titulacion,$c,$nomb,$vistaurl,$titulacion->alumno,$ae,$seccion,$academia);
    }

    public function crearPDFAR($titulacion,$c,$nomb,$vistaurl,$nc,$ae,$seccion,$academia){
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date   = date('d')." de ".$meses[date('m')-1]." de ".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nc','ae','seccion','academia'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/AsignacionR/Asignacion_Revisores_'.$data->alumno.'.pdf');
        //return $t_vocals;
        return $pdf->stream('Asignacion_Revisores_'.$data->alumno.'.pdf');
    }

    public function crear_liberacion_p(Request $request,$nc){
        $oficio = $request->input('oficio');
        $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
        if($ae->asesor_externo != 'N'){
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        else{
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        if (file_exists('pdf/LP/LP_'.$titulacion->alumno.'.pdf')){
            File::delete('pdf/LP/LP_'.$titulacion->alumno.'.pdf');
        }
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','no_de_control','reticula')
                                 ->where('no_de_control','=',"$titulacion->alumno")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                    ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->get();

        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->first();
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc',$jefediv->rfc)->first();
        $seccion    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
        $academia   =Puesto::select('g.grado as grado','d.apellidos_empleado','d.nombre_empleado')->join('grados as g','g.rfc','=','puesto_d.rfc')->join('personal as d','d.rfc','=','puesto_d.rfc')->where('puesto_d.puesto','PRESIDENTE ACADEMIA')->where('puesto_d.clave_area','=',Auth::user()->clave_area)->first();
        $vistaurl="pdfs.liberacion_p";
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Liberación de Proyecto'));
        return $this->crearPDFLP($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion,$academia);
    }

    public function crearPDFLP($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion,$academia){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $nof  = $oficio;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','jefediv','gjdiv','seccion','academia'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/LP/LP_'.$data->alumno.'.pdf');
        //return $data3;
        return $pdf->stream('Liberacion_Proyecto_'.$data->alumno.'.pdf');
    }

    public function crear_autorizacion_t(Request $request,$nc){
        $oficio = $request->input('oficio');
        $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
        if($ae->asesor_externo != 'N'){
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        else{
          $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
                 ->join('personal as a','a.rfc','=','titulaciones.asesor')
                 ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                 ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                 ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                 ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                 ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                 ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
                 ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
                 ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
                 ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
                 ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
                 ->where('titulaciones.id',$nc)
                 ->first();
        }
        if (file_exists('pdf/ATA/ATA_'.$titulacion->alumno.'.pdf')){
                     File::delete('pdf/ATA/ATA_'.$titulacion->alumno.'.pdf');
        }
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','reticula','no_de_control')
                        ->where('no_de_control',$titulacion->alumno)->first();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                                        ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->first();
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->first();
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc',$jefediv->rfc)->first();
        $jefedsc    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
        $academia   =Puesto::select('g.grado as grado','d.apellidos_empleado','d.nombre_empleado')->join('grados as g','g.rfc','=','puesto_d.rfc')->join('personal as d','d.rfc','=','puesto_d.rfc')->where('puesto_d.puesto','PRESIDENTE ACADEMIA')->where('puesto_d.clave_area','=',Auth::user()->clave_area)->first();

        $vistaurl="pdfs.autorizacion_t";
        $t=Titulacion::where('id', $nc)->update(array('proceso' => 'Autorización de tema'));
        return $this->crearPDFATA($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$jefedsc,$academia);
    }

    public function crearPDFATA($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$jefedsc,$academia){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $titu   = $titulacion;
        $carrera  = $c;
        $alumno  = $nomb;
        $nof  = $oficio;
        $jefediv = $jefediv;
        $gjdiv = $gjdiv;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu', 'carrera','alumno','date','nof','nc','jefediv','gjdiv','jefedsc','academia'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/ATA/ATA_'.$titu->alumno.'.pdf');
        return $pdf->stream('ATA_'.$nc.'.pdf');
    }

    public function crear_invitacion(Request $request,$nc){
      $ae=Titulacion::select('asesor_externo')->where('id',$nc)->first();
      if($ae->asesor_externo != 'N'){
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),'titulaciones.asesor_externo','op.nombre_opcion as nombre_opcion','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','sg.grado as sg','op.opcion_titulacion as op')
               ->join('personal as a','a.rfc','=','titulaciones.asesor')
               ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
               ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
               ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
               ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
               ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
               ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
               ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
               ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
               ->where('titulaciones.id',$nc)
               ->first();
      }
      else{
        $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
               ->join('personal as a','a.rfc','=','titulaciones.asesor')
               ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
               ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
               ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
               ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
               ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
               ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
               ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
               ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
               ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
               ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
               ->where('titulaciones.id',$nc)
               ->first();
      }
      if (file_exists('pdf/INV/ICT_'.$titulacion->alumno.'.pdf')){
                   File::delete('pdf/INV/ICT_'.$titulacion->alumno.'.pdf');
      }
      $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','no_de_control','reticula')
                               ->where('no_de_control','=',"$titulacion->alumno")->get();
      $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                       ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->get();

        $date  = $request->input('fecha');
        $fecha = strtotime($request->input('fecha'));
        $lugar = mb_strtoupper($request->input('lugar'),'UTF-8');
        $hora  = mb_strtoupper($request->input('hora'),'UTF-8');
        $vistaurl="pdfs.invitacion";
        $t=Titulacion::where('id', $nc)->update(array('estatus'=>'TITULADO','proceso' => 'Invitación a Ceremonia de Titulación','fecha_cer' => "$date",'lugar' => "$lugar",'hora' =>"$hora"));
        //return $c;
        return $this->crearPDFINV($titulacion,$c,$nomb,$vistaurl,$nc,$fecha,$lugar,$hora,$ae);
    }

    public function crearPDFINV($titulacion,$c,$nomb,$vistaurl,$nc,$fecha,$lugar,$hora,$ae){
        $fecha = $fecha;
        $lugar = $lugar;
        $hora  = $hora;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dia = array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $date   = $dia[date('w',$fecha)]." ".date('d',$fecha)." DE ".$meses[date('m',$fecha)-1]." DE ".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nc','fecha','lugar','hora','ae'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/INV/ICT_'.$data->alumno.'.pdf');
        //return $data;
        return $pdf->stream('Invitacion_'.$data->alumno.'.pdf');
    }

    public function crear_control_p($nc){
      $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
             ->join('personal as a','a.rfc','=','titulaciones.asesor')
             ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
             ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
             ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
             ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
             ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
             ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
             ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
             ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
             ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
             ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
             ->where('titulaciones.id',$nc)
             ->first();
      $seccion    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
      $alumno=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','reticula','no_de_control')
                             ->where('no_de_control','=',"$titulacion->alumno")->first();
      $carrera=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                      ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->first();
      if (file_exists('pdf/CP/CP_'.$alumno->no_de_control.'.pdf')){
        File::delete('pdf/CP/CP_'.$alumno->no_de_control.'.pdf');
      }
      $vistaurl="pdfs.control_p";
      //return $titulacion;
      return $this->crearPDFCP($titulacion,$alumno,$carrera,$seccion,$vistaurl);
    }

    public function crearPDFCP($titulacion,$alumno,$carrera,$seccion,$vistaurl){
      $view   = \View::make($vistaurl, compact('titulacion', 'alumno','carrera','seccion'))->render();
      $pdf    = \App::make('snappy.pdf.wrapper');
      $pdf    ->loadHTML($view)->save('pdf/CP/CP_'.$alumno->no_de_control.'.pdf');
      //return $data;
      return $pdf->stream('CP_'.$alumno->no_de_control.'.pdf');
    }

    public function crear_control_b($nc){
      $titulacion=Titulacion::select('titulaciones.estatus','titulaciones.alumno','titulaciones.id','titulaciones.nombre_proyecto',DB::raw("CONCAT(a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as nombre_opcion','op.opcion_titulacion as op','ag.grado as ag','pg.grado as pg','vpg.grado as vpg','vsg.grado as vsg','sg.grado as sg')
             ->join('personal as a','a.rfc','=','titulaciones.asesor')
             ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
             ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
             ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
             ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
             ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
             ->join('grados as ag','ag.rfc','=','titulaciones.asesor')
             ->join('grados as pg','pg.rfc','=','titulaciones.presidente')
             ->join('grados as sg','sg.rfc','=','titulaciones.secretario')
             ->join('grados as vpg','vpg.rfc','=','titulaciones.vocal_propietario')
             ->join('grados as vsg','vsg.rfc','=','titulaciones.vocal_suplente')
             ->where('titulaciones.id',$nc)
             ->first();
      $seccion    = Jefe::where('clave_area','=',Auth::user()->clave_area)->first();
      $alumno=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'sexo','reticula','no_de_control')
                             ->where('no_de_control','=',"$titulacion->alumno")->first();
      $carrera=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.carrera')
                      ->where('alumnos.no_de_control',$titulacion->alumno)->groupBy('nombre')->first();
      if (file_exists('pdf/CB/CB_'.$alumno->no_de_control.'.pdf')){
        File::delete('pdf/CB/CB_'.$alumno->no_de_control.'.pdf');
      }
      $vistaurl="pdfs.control_b";
      //return $titulacion;
      return $this->crearPDFCB($titulacion,$alumno,$carrera,$seccion,$vistaurl);
    }

    public function crearPDFCB($titulacion,$alumno,$carrera,$seccion,$vistaurl){
      $view   = \View::make($vistaurl, compact('titulacion', 'alumno','carrera','seccion'))->render();
      $pdf    = \App::make('snappy.pdf.wrapper');
      $pdf    ->loadHTML($view)->save('pdf/CB/CB_'.$alumno->no_de_control.'.pdf');
      //return $data;
      return $pdf->stream('CB_'.$alumno->no_de_control.'.pdf');
    }
    //TITULACIONES - ESTADISTICAS

    public function crear_reporte_a(Request $request){
        $a1= $request->input('anio1');
        $oficio = $request->input('oficio');
        if (file_exists('pdf/Reportes/'.$a1.'.pdf')){
            File::delete('pdf/Reportes/'.$a1.'.pdf');
        }
            $vistaurl="pdfs.reporte_a";
            $opc=OpcionesTitulacion::select('id')->where('nombre_opcion','LIKE','%CENEVAL%');
            $ti1=Titulacion::select('titulaciones.nombre_proyecto as proyecto','titulaciones.asesor as asesor','titulaciones.estatus as estatus', 'titulaciones.created_at as created_at','titulaciones.opc_titu as opc_titu')
                            ->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                            ->whereBetween('titulaciones.created_at', [$a1."-01-01", $a1."-06-30"])
                            ->where('nombre_opcion','NOT LIKE','%CENEVAL%')
                            ->orderBy('titulaciones.created_at','DESC')
                            ->get();
            $ti2=Titulacion::select('titulaciones.nombre_proyecto as proyecto','titulaciones.asesor as asesor','titulaciones.estatus as estatus', 'titulaciones.created_at as created_at')
                            ->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                            ->whereBetween('titulaciones.created_at', [$a1."-08-01", $a1."-12-31"])
                            ->orderBy('titulaciones.created_at','DESC')
                            ->get();
            $sum1=Titulacion::select('o.nombre_opcion as opcion',DB::raw('count(*) as total'),'opc_titu')->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                            ->whereBetween('titulaciones.created_at', [$a1."-01-01", $a1."-06-30"])
                            ->where('o.nombre_opcion','NOT LIKE','%CENEVAL%')
                            ->groupBy('o.nombre_opcion','opc_titu')
                            ->get();
            $sum2=Titulacion::select('o.nombre_opcion as opcion',DB::raw('count(*) as total'),'opc_titu')->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                            ->whereBetween('titulaciones.created_at', [$a1."-08-01", $a1."-12-31"])
                            ->where('o.nombre_opcion','NOT LIKE','%CENEVAL%')
                            ->groupBy('o.nombre_opcion','opc_titu')
                            ->get();

            //return $now->year;
            return $this->crearPDFRA($ti1,$a1,$ti2,$sum1,$sum2,$vistaurl,$oficio);
    }

    public function crearPDFRA($ti1,$a1,$ti2,$sum1,$sum2,$vistaurl,$oficio){
        $titu1=$ti1;
        $titu2=$ti2;
        $su1=$sum1;
        $su2=$sum2;
        $nof=$oficio;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu1','titu2', 'a1','su1','su2','date','nof'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/Reportes/'.$a1.'.pdf');
        return $pdf->stream(''.$a1.'.pdf');
    }

    public function crear_reporte_d(Request $request){
        $asesor= $request->input('docente');
        $anio= $request->input('anio');
        $sem= $request->semestre;
        if (file_exists('pdf/Reportes/'.$asesor.' '.$anio.'.pdf')){
            File::delete('pdf/Reportes/'.$asesor.' '.$anio.'.pdf');
        }

            $vistaurl="pdfs.reporte_d";
            $nombrea=Personal::select(DB::raw("CONCAT(personal.nombre_empleado,' ',personal.apellidos_empleado) AS completo"),'personal.especializacion')
                            ->where('rfc','LIKE',"$asesor")->get();
            if($sem == 'E-J'){
                $ti=Titulacion::select('titulaciones.nombre_proyecto as proyecto','titulaciones.alumno as alumno','titulaciones.plan as plan','titulaciones.asesor as asesor','titulaciones.estatus as estatus', 'titulaciones.created_at as created_at','titulaciones.opc_titu as opc_titu')
                                ->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                                ->whereBetween('titulaciones.created_at', [$anio."-01-01", $anio."-06-30"])
                                ->where('nombre_opcion','NOT LIKE','%CENEVAL%')
                                ->where('asesor','LIKE',"%$asesor%")
                                ->orderBy('titulaciones.created_at','DESC')
                                ->get();

                $sum=Titulacion::select('o.nombre_opcion as opcion',DB::raw('count(*) as total'),'opc_titu')->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                            ->whereBetween('titulaciones.created_at', [$anio."-01-01", $anio."-06-30"])
                            ->where('o.nombre_opcion','NOT LIKE','%CENEVAL%')
                            ->where('asesor','LIKE',"%$asesor%")
                            ->groupBy('o.nombre_opcion','opc_titu')
                            ->get();
            }
            else{
                $ti=Titulacion::select('titulaciones.proyecto as proyecto','titulaciones.asesor as asesor','titulaciones.estatus as estatus', 'titulaciones.created_at as created_at','titulaciones.opc_titu as opc_titu')
                                ->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                                ->whereBetween('titulaciones.created_at', [$anio."-08-01", $anio."-12-31"])
                                ->where('nombre_opcion','NOT LIKE','%CENEVAL%')
                                ->where('asesor','LIKE',"%$asesor%")
                                ->orderBy('titulaciones.created_at','DESC')
                                ->get();

                $sum=Titulacion::select('o.nombre_opcion as opcion',DB::raw('count(*) as total'),'opc_titu')->join('opciones_titulacion as o', 'o.id','=','titulaciones.opc_titu')
                                ->whereBetween('titulaciones.created_at', [$anio."-08-01", $anio."-12-31"])
                                ->where('o.nombre_opcion','NOT LIKE','%CENEVAL%')
                                ->where('asesor','LIKE',"%$asesor%")
                                ->groupBy('o.nombre_opcion','opc_titu')
                                ->get();
            }
            //return $nombrea;
            return $this->crearPDFRD($ti,$anio,$sem,$nombrea,$vistaurl,$sum,$asesor);
    }

    public function crearPDFRD($ti,$anio,$sem,$nombrea,$vistaurl,$sum,$asesor){
        $titu=$ti;
        $su=$sum;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu', 'anio','sem','su','nombrea','date'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/Reportes/'.$asesor.' '.$anio.'.pdf');
        return $pdf->stream(''.$asesor.' '.$anio.'.pdf');
    }



}
