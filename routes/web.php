<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
  //Módulo de Revisión y Autorización de Proyectos de Titulación por proyectosDocentes
  Route::resource('proyectoTitulacionCtl','proyectoTitulacionController',[
                  'except' => ['destroy']
  ]);
  Route::get('showRevisiones/{nc}', 'proyectoTitulacionController@showRevisiones')->name('showRevisiones');

  //Módulo de Administración de Usuarios
  Route::get('/admin', 'usuariosController@index')->name('admin');
  Route::resource('usuariosCtl','usuariosController');

  //Módulo de Actividades Complementarias
    Route::resource('actividadescomp','ActividadesCompController',[
                    'except' => ['destroy']
    ]);
    //Opciones de Titulaciónote
    Route::resource('opcionestitulacionCtl','opcionestitulacionController');


    Route::get('listar_ac/{nc}', 'ActividadesCompController@listar_ac')->name('listar_ac');

    Route::post('crear_constancia_ac/{nc}', 'PDFController@crear_constancia_ac')->name('crear_constancia_ac');

    Route::resource('catalogoac','CatalogoACController');

    Route::resource('grupocestudio','GrupoCEstudioController',[
            'except' => ['destroy']
        ]);

    Route::resource('titulaciones','TitulacionController',[
            'except' => ['destroy']
        ]);

    Route::resource('revisiones','RevisionController',[
            'except' => ['destroy']
        ]);

    Route::resource('procesotitulacion','ProcesoTitulacionController');

    Route::post('crear_lista_c','PDFController@crear_lista_circulos')->name('crear_lista_c');

    Route::post('crear_horario','PDFController@crear_horario')->name('crear_horario');

    Route::get('listar_grupo/{nc}', 'GrupoCEstudioController@listar_grupo')->name('listar_grupo');

    Route::post('crear_constancia_ce/{nc}', 'PDFController@crear_constancia_ce')->name('crear_constancia_ce');

    Route::get('gen_lista_c','GrupoCEstudioController@gen_lista_c')->name('gen_lista_c');

    Route::get('gen_horario','GrupoCEstudioController@gen_horario')->name('gen_horario');

    Route::post('crear_reporte_a','PDFController@crear_reporte_a')->name('crear_reporte_a');

    Route::post('crear_horario','PDFController@crear_horario')->name('crear_horario');

    Route::post('crear_asignacion_s/{nc}', 'PDFController@crear_asignacion_s')->name('crear_asignacion_s');


    Route::post('crear_impresion_d/{nc}', 'PDFController@crear_impresion_d')->name('crear_impresion_d');

    Route::post('crear_asignacion_r/{nc}', 'PDFController@crear_asignacion_r')->name('crear_asignacion_r');

    Route::post('crear_liberacion_p/{nc}', 'PDFController@crear_liberacion_p')->name('crear_liberacion_p');

    Route::post('crear_invitacion/{nc}', 'PDFController@crear_invitacion')->name('crear_invitacion');

    Route::get('crear_control_p/{nc}', 'PDFController@crear_control_p')->name('control_p');

    Route::get('crear_control_b/{nc}', 'PDFController@crear_control_b')->name('control_b');

    Route::post('crear_autorizacion_t/{nc}', 'PDFController@crear_autorizacion_t')->name('crear_autorizacion_t');

    Route::get('expediente_titulacion/{nc}', 'TitulacionController@expediente_titulacion')->name('expediente_titulacion');

    Route::post('gen_documentos/{nc}', 'TitulacionController@gen_documentos')->name('gen_documentos');

    Route::get('gen_reporte_a','TitulacionController@gen_reporte_a')->name('gen_reporte_a');

    Route::get('gen_asignacion_s','TitulacionController@gen_asignacion_s')->name('gen_asignacion_s');

    Route::get('gen_invitacion','TitulacionController@gen_invitacion')->name('gen_invitacion');

    Route::get('gen_autorizacion_t','TitulacionController@gen_autorizacion_t')->name('gen_autorizacion_t');

    Route::get('gen_impresion_d','TitulacionController@gen_asignacion_s')->name('gen_impresion_d');

    Route::get('gen_asignacion_r','TitulacionController@gen_asignacion_s')->name('gen_asignacion_r');

    Route::get('gen_liberacion_p','TitulacionController@gen_asignacion_s')->name('gen_liberacion_p');

    Route::post('gen_asignacion_s', 'TitulacionController@gen_asignacion_s')->name('gen_asignacion_s');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
