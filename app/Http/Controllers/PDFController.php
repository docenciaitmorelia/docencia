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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;
use Barryvdh\Snappy;

class PDFController extends Controller
{

    public function crearPDFAC($datos,$datos2,$datos3,$vistaurl,$nc,$carrera,$dsc,$doc,$esc,$nof){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $datos;
        $data2  = $datos2;
        $data3  = $datos3;
        $data4  = $carrera;
        $data5  = $dsc;
        $data6  = $doc;
        $data7  = $esc;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'date','data2','data3','date','nc','data4','data5','data6','data7','nof'))->render();
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
                        ->where('alumno','LIKE',"%$nc%")->orderBy('fecha_del','ASC')->orderBy('fecha_al','ASC')->get();
            $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo",'sexo'))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
            $sum=ActividadesComp::where('alumno','LIKE',"%$nc%")
                        ->sum(DB::raw('calificacion * creditos'));
            $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();

            $prom=(double)$sum/5;
            $dsc=Personal::select(DB::raw("CONCAT(personal.nombre_empleado,' ',personal.apellidos_empleado) AS completo"),'personal.especializacion','personal.sexo_empleado AS sexo')->join('jefes','personal.rfc','=','jefes.rfc')->where('jefes.clave_area','=','DSC')->get();

            $doc=Personal::select(DB::raw("CONCAT(personal.nombre_empleado,' ',personal.apellidos_empleado) AS completo"),'personal.especializacion','personal.sexo_empleado AS sexo')->join('jefes','personal.rfc','=','jefes.rfc')->where('jefes.clave_area','LIKE','%DSCDOCENCIA%')->get();

            $esc=Personal::select(DB::raw("CONCAT(personal.nombre_empleado,' ',personal.apellidos_empleado) AS completo"),'personal.especializacion','personal.sexo_empleado AS sexo')->join('jefes','personal.rfc','=','jefes.rfc')->where('jefes.clave_area','LIKE','%SERVESCOLARES%')->get();

            return $this->crearPDFAC($ac,$nomb,$prom, $vistaurl,$nc,$c,$dsc,$doc,$esc,$input);
    }

    public function crearPDFCE($alumno,$materia,$ciclo,$vistaurl,$carrera,$dsc,$nc,$nof){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $alumno;
        $data2  = $materia;
        $data3  = $ciclo;
        $data4  = $carrera;
        $data5  = $dsc;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y');
        $anio   = date('Y');
        $view   = \View::make($vistaurl, compact('data', 'date','data2','data3','data4','data5','nc','nof','anio'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view)->save('pdf/Circulos/'.$nc.'.pdf');
        return $pdf->stream(''.$nc.'.pdf');
    }

    public function crear_constancia_ce(Request $request,$nc){
        $input = $request->input('oficio');
        if (file_exists('pdf/Circulos/'.$nc.'.pdf')){
            File::delete('pdf/Circulos/'.$nc.'.pdf');
        }

            $vistaurl="pdfs.constancia_ce";
            $alumno=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();

            $materia=GrupoCEstudio::select('materias.nombre_completo_materia as nombre')->join('materias','grupo_cestudios.materia','=','materias.id')
                            ->where('grupo_cestudios.tutor','LIKE',"%$nc%")->get();

            $carrera=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();

            $ciclo=GrupoCEstudio::select('ciclo_escolar')->where('grupo_cestudios.tutor','LIKE',"%$nc%")->get();

            $dsc=Personal::select(DB::raw("CONCAT(personal.nombre_empleado,' ',personal.apellidos_empleado) AS completo"),'personal.especializacion','personal.sexo_empleado AS sexo')->join('jefes','personal.rfc','=','jefes.rfc')->where('jefes.clave_area','=','DSC')->get();

            return $this->crearPDFCE($alumno,$materia,$ciclo,$vistaurl,$carrera,$dsc,$nc,$input);

    }

    public function crear_reporte_a(Request $request){
        $a1= $request->input('anio1');
        $a2= $request->input('anio2');
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
            return $this->crearPDFRA($ti1,$a1,$ti2,$sum1,$sum2,$vistaurl);
    }

    public function crearPDFRA($ti1,$a1,$ti2,$sum1,$sum2,$vistaurl){
        $titu1=$ti1;
        $titu2=$ti2;
        $su1=$sum1;
        $su2=$sum2;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('titu1','titu2', 'a1','su1','su2','date'))->render();
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

    public function crear_asignacion_s(Request $request,$nc){
        $oficio = $request->input('oficio');
        $seccion = $request->input('seccion');
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion','op.detalle_opcion as detalle_opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();
        $desc=$titulacion[0]->detalle_opcion;
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->get();
        $rfcdiv     = $jefediv[0]->rfc;
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc','=',"$rfcdiv")->get();
        if($desc=='Protocolario'){
          $vistaurl="pdfs.asignacion_sp";
        }
        else{
          $vistaurl="pdfs.asignacion_s";
        }
        $ord = ProcesoTitulacion::select('orden')->where('descripcion','LIKE',"%Asignación de Sinodales%")->pluck('orden');
        $t=Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Asignación de Sinodales'));
        return $this->crearPDFAS($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$seccion,$jefediv,$gjdiv);

    }

    public function crearPDFAS($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$seccion,$jefediv,$gjdiv){
        $meses  = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $nof    = $oficio;
        $secc   = $seccion;
        $jefediv=$jefediv;
        $gjdiv  =$gjdiv;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses  = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','secc','jefediv','gjdiv'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        //$pdf    ->loadHTML($view)->save('pdf/AsignacionS/Asignacion_Sinodales_'.$nc.'.pdf');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Asignacion_Sinodales_'.$nc.'.pdf');
    }

    public function crear_impresion_d(Request $request,$nc){
        $oficio     = $request->input('oficio');
        $seccion = $request->input('seccion');
        $nomb       = Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"),'reticula')
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $ret        = $nomb[0]->reticula;
        $c          = Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                        ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion = Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->get();
        $rfcdiv     = $jefediv[0]->rfc;
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc','=',"$rfcdiv")->get();
        if($ret<2010){
          $vistaurl   = "pdfs.impresion_d";
        }
        else{
          $vistaurl   = "pdfs.impresion_dti";
        }
        $t          = Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Impresión Definitiva'));
        return $this->crearPDFID($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion);
    }

    public function crearPDFID($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion){
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $nof  = $oficio;
        $secc = $seccion;
        $jefediv=$jefediv;
        $gjdiv  =$gjdiv;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dia = array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        $date   = $dia[date('w')]." ".date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','jefediv','gjdiv','secc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Impresion_Definitiva_'.$nc.'.pdf');
    }

    public function crear_asignacion_r(Request $request,$nc){
        $depto = $request->input('depto');
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();
        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->get();
        $vistaurl="pdfs.asignacion_r";
        $t=Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Asignación de Revisores'));
        return $this->crearPDFAR($titulacion,$c,$nomb,$vistaurl,$nc,$depto);
    }

    public function crearPDFAR($titulacion,$c,$nomb,$vistaurl,$nc,$depto){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $dep = $depto;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nc','dep'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Asignacion_Revisores_'.$nc.'.pdf');
    }

    public function crear_liberacion_p(Request $request,$nc){
        $oficio = $request->input('oficio');
        $seccion = $request->input('seccion');
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();

        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->get();
        $rfcdiv     = $jefediv[0]->rfc;
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc','=',"$rfcdiv")->get();
        $vistaurl="pdfs.liberacion_p";
        $t=Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Liberación de Proyecto'));
        return $this->crearPDFLP($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion);
    }

    public function crearPDFLP($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $nof  = $oficio;
        $secc = $seccion;
        $jefediv = $jefediv;
        $gjdiv = $gjdiv;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','jefediv','gjdiv','secc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Liberacion_Proyecto_'.$nc.'.pdf');
    }

    public function crear_registro(Request $request,$nc){
        $oficio = $request->input('oficio');
        $seccion = $request->input('seccion');
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();

        $jefediv    = Jefe::where('descripcion_area','=','DIVISION DE ESTUDIOS PROFESIONALES')->get();
        $rfcdiv     = $jefediv[0]->rfc;
        $gjdiv      = Personal::select('sexo_empleado')->where('rfc','=',"$rfcdiv")->get();
        $vistaurl="pdfs.liberacion_p";
        $t=Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Liberación de Proyecto'));
        return $this->crearPDFRT($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion);
    }

    public function crearPDFRT($titulacion,$c,$nomb,$oficio,$vistaurl,$nc,$jefediv,$gjdiv,$seccion){
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $nof  = $oficio;
        $secc = $seccion;
        $jefediv = $jefediv;
        $gjdiv = $gjdiv;
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $date   = date('d')."/".$meses[date('m')-1]."/".date('Y') ;
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','jefediv','gjdiv','secc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        return $pdf->stream('Liberacion_Proyecto_'.$nc.'.pdf');
    }

    public function crear_invitacion(Request $request,$nc){
        $fecha = strtotime($request->input('fecha'));
        $lugar = $request->input('lugar');
        $hora  = $request->input('hora');
        $nomb=Alumno::select(DB::raw("CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre_alumno) AS completo"))
                        ->where('no_de_control','LIKE',"%$nc%")->get();
        $c=Alumno::select('carreras.nombre_carrera as nombre')->join('carreras','alumnos.carrera','=','carreras.id')
                            ->where('alumnos.no_de_control','LIKE',"%$nc%")->get();
        $titulacion= Titulacion::select('titulaciones.id','titulaciones.nombre_proyecto as proyecto',DB::raw("CONCAT(a.especializacion,' ',a.apellidos_empleado,' ',a.nombre_empleado) AS asesor"),DB::raw("CONCAT(s1.especializacion,' ',s1.apellidos_empleado,' ',s1.nombre_empleado) AS presidente"),DB::raw("CONCAT(s2.especializacion,' ',s2.apellidos_empleado,' ',s2.nombre_empleado) AS secretario"),DB::raw("CONCAT(s3.especializacion,' ',s3.apellidos_empleado,' ',s3.nombre_empleado) AS vocal_propietario"),DB::raw("CONCAT(s4.especializacion,' ',s4.apellidos_empleado,' ',s4.nombre_empleado) AS vocal_suplente"),'op.nombre_opcion as opcion')
                        ->join('personal as a','a.rfc','=','titulaciones.asesor')
                        ->join('personal as s1','s1.rfc','=','titulaciones.presidente')
                        ->join('personal as s2','s2.rfc','=','titulaciones.secretario')
                        ->join('personal as s3','s3.rfc','=','titulaciones.vocal_propietario')
                        ->join('personal as s4','s4.rfc','=','titulaciones.vocal_suplente')
                        ->join('opciones_titulacion as op','op.id','=','titulaciones.opc_titu')
                        ->where('titulaciones.alumno','LIKE',"%$nc%")
                        ->where('titulaciones.estatus','=',"ACTIVO")
                        ->get();
        $vistaurl="pdfs.invitacion";
        $t=Titulacion::where('alumno', $nc)->where('estatus','=',"ACTIVO")->update(array('proceso' => 'Liberación de Proyecto'));
        return $this->crearPDFINV($titulacion,$c,$nomb,$vistaurl,$nc,$fecha,$lugar,$hora);
    }

    public function crearPDFINV($titulacion,$c,$nomb,$vistaurl,$nc,$fecha,$lugar,$hora){
        $fecha = $fecha;
        $lugar = $lugar;
        $hora  = $hora;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dia = array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        $data   = $titulacion;
        $data2  = $c;
        $data3  = $nomb;
        $date   = $dia[date('w',$fecha)]." ".date('d',$fecha)." DE ".$meses[date('m',$fecha)-1]." DEL ".date('Y') ;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $view   = \View::make($vistaurl, compact('data', 'data2','data3','date','nof','nc','jefediv','gjdiv','secc'))->render();
        $pdf    = \App::make('snappy.pdf.wrapper');
        $pdf    ->loadHTML($view);
        //return $date;
        return $pdf->stream('Invitacion_'.$nc.'.pdf');
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
}
