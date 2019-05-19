<?php
/** @var $router \Illuminate\Routing\Router */

$router->post('wp-admin/submmtion/destroy/all', 'SubmssionsController@multi_delete');
$router->post('wp-admin/submmtion/destroy/{id}', 'SubmssionsController@destroy');
$router->post('wp-admin/submmtion/update/{id}', 'SubmssionsController@update');

$router->post('wp-admin/submmtion/approve/{id}', 'SubmssionsController@approve');

$router->post('wp-admin/document/destroy', 'SubmssionsController@DocDelete');

$router->post('wp-admin/exportsub', 'SettingsController@ExportPost');
$router->post('wp-admin/exportdoc', 'SettingsController@exportdocpost');

$router->post('wp-admin/importsub', 'SettingsController@ImportSub');
$router->post('wp-admin/importdoc', 'SettingsController@importdoc');

/*
 ** admin in front-end
 */
$router->get('admin/control', 'Submissionsfrontcontrol@frontcontrol');

$router->post('admin/control/destroy/all', 'Submissionsfrontcontrol@multi_delete');
$router->post('admin/control/destroy/{id}', 'Submissionsfrontcontrol@destroy');
$router->post('admin/control/update/{id}', 'Submissionsfrontcontrol@update');

$router->post('admin/control/approve/{id}', 'Submissionsfrontcontrol@approve');

$router->post('admin/control/destroy', 'Submissionsfrontcontrol@DocDelete');
/*
 ** end admin in front-end
 */
/*
front-end
 */
$router->get('upload/yourresearch', 'SubmssionsControllerFront@index');
$router->post('upload/yourresearch', 'SubmssionsControllerFront@store');

$router->get('my-submssion', 'SubmssionsControllerFront@show');

$router->get('submission/{id}', 'SubmssionsControllerFront@single');

$router->post('submmtion/destroy/{id}', 'SubmssionsControllerFront@destroy');
$router->post('submmtion/update/{id}', 'SubmssionsControllerFront@update');

$router->post('document/destroy', 'SubmssionsControllerFront@DocDelete');

$router->get('makesubmssion_as_done/{user_id}/{submssion_id}/{done}', 'SubmssionsControllerFront@makesubmssion_as_done');

//$router->get('/key-generate', function() {
//	return str_random(32);
//});
