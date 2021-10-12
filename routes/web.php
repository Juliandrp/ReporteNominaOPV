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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) { error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); }




/* RUTAS IMAGENES TEXTO */

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
//Route::get('/', 'Admin\InicioController@index')->name('inicio');
Route::get('/', 'Seguridad\LoginController@index')->name('inicio');
Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'superadmin']], function () {


     /* RUTAS DEL MENU */
     Route::get('menu', 'MenuController@index')->name('menu');
     Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
     Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
     Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
     Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
     Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');
     Route::get('rol/{id}/elimniar', 'MenuController@eliminar')->name('eliminar_menu');

     /* RUTAS DEL ROL */
     Route::get('rol', 'RolController@index')->name('rol');
     Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
     Route::post('rol', 'RolController@guardar')->name('guardar_rol');
     Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol');
     Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol');
     Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol');

     /* RUTAS DEL MENUROL */
     Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
     Route::post('menu-rol', 'MenuRolController@guardar')->name('guardar_menu_rol');

     /* RUTAS DE LA EMPRESA */
     Route::get('empresa', 'EmpresaController@index')->name('empresa');
     Route::get('empresa/crear', 'EmpresaController@crear')->name('crear_empresa');
     Route::post('empresa', 'EmpresaController@guardar')->name('guardar_empresa');
     Route::get('empresa/{id}/editar', 'EmpresaController@editar')->name('editar_empresa');
     Route::put('empresa/{id}', 'EmpresaController@actualizar')->name('actualizar_empresa');

     /* RUTAS DEL PERMISO */
     Route::get('permiso', 'PermisoController@index')->name('permiso');
     Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
     Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso');
     Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso');
     Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso');
     Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso');

     /* RUTAS DEL PERMISOROL */
     Route::get('permiso-rol', 'PermisoRolController@index')->name('permiso_rol');
     Route::post('permiso-rol', 'PermisoRolController@guardar')->name('guardar_permiso_rol');



});


Route::group(['middleware' => ['auth']], function () {

Route::get('/tablero', 'AdminController@index')->name('tablero');

Route::get('informes', 'AdminController@informes')->name('informes')->middleware('superConsultor');

/* RUTAS DEL USUARIO */
Route::get('usuario', 'UsuarioController@index')->name('usuario')->middleware('superEditor');
Route::get('usuario/crear', 'UsuarioController@crear')->name('crear_usuario')->middleware('superEditor');
Route::post('usuario', 'UsuarioController@guardar')->name('guardar_usuario')->middleware('superEditor');
Route::get('usuario/{id}/editar', 'UsuarioController@editar')->name('editar_usuario')->middleware('superEditor');
Route::get('usuario/{id}/password', 'UsuarioController@editarpassword')->name('editar_password')->middleware('superEditor');
Route::put('usuario/{id}', 'UsuarioController@actualizar')->name('actualizar_usuario')->middleware('superEditor');
Route::put('password/{id}', 'UsuarioController@actualizarpassword')->name('actualizar_password')->middleware('superEditor');
Route::put('password1/{id}', 'UsuarioController@actualizarpassword1')->name('actualizar_password1');


/* RUTAS DE HORAS X USUARIO */

Route::get('hoursxuser', 'Nomina\HoursxuserController@index')->name('hours')->middleware('superEditor');
Route::post('hoursxuser', 'Nomina\HoursxuserController@store')->name('guardar_turno')->middleware('superEditor');
Route::get('hoursxuser/{id}/editar', 'Nomina\HoursxuserController@edit')->name('editar_turno')->middleware('superEditor');
Route::put('hoursxuser/{id}', 'Nomina\HoursxuserController@update')->name('actualizar_turno')->middleware('superEditor');
Route::post('liquidar', 'Nomina\HoursxuserController@supervisar')->name('liquidar');

//RUTA PARA CONSULTA DE INFORMES
Route::get('informesh', 'Nomina\HoursxuserController@informes')->name('hoursinfo')->middleware('superEditor');
Route::get('informeshc', 'Nomina\HoursxuserController@informes1')->name('hoursinfoc')->middleware('superEditor');
Route::get('select_user', 'UsuarioController@select')->name('select_user');

Route::get('select_position', 'Nomina\PositionController@select')->name('select_position');

/* RUTAS DE LISTAR CARGOS */
Route::get('position', 'Nomina\PositionController@index')->name('position');
Route::post('position', 'Nomina\PositionController@store')->name('guardar_cargo')->middleware('superEditor');

//RUTA PARA CONSULTA DE INFORMES DE LIQUIDACION
Route::get('informe-liquid', 'Nomina\LiquidationxuserController@informes')->name('liquidinfo')->middleware('superEditor');
Route::get('informe-liquidc', 'Nomina\LiquidationxuserController@informes1')->name('liquidinfoc')->middleware('superEditor');
Route::get('select_quincena', 'Nomina\LiquidationxuserController@select')->name('select_quincena');





});








