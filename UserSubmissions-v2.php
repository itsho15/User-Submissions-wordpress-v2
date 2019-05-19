<?php
/**
 *
 * Plugin Name:       NTSC User Submission
 * Description:       (This a simple plugin to Create custom table into database , and save events data on it)
 * Version:           1.0
 * Author:            By New Waves Qatar
 * Author URI:        https://www.new-waves.net/
 */

/*
|--------------------------------------------------------------------------
| Environment Settings
|--------------------------------------------------------------------------
| To make our plugin portable, we don't use an .env file.  However, if you
| want to use one, simple add one to the plugin's directory.
 */
putenv('APP_ENV=production');
putenv('APP_DEBUG=true');


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
 */
$app = require __DIR__ . '/bootstrap/app.php';


/*
|--------------------------------------------------------------------------
| Override the Application Error Reporting Level
|--------------------------------------------------------------------------
| You can override the error reporting level to disable output and prevent
| warning thrown by other plugins.
 */
error_reporting((config('app.debug') ? E_ALL : 0));

/*
|--------------------------------------------------------------------------
| Resolve Plugin from LumenHelper Example
|--------------------------------------------------------------------------
| You can resolve each plugin by it's namespace.
 */
//dd(\App\Helpers\LumenHelper::plugin('App')->config());

if (!function_exists('wpLumen')) {
	function wpLumen($namespace = null) {
		return \App\Helpers\LumenHelper::plugin($namespace);
	}
}
