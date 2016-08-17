<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Kiev');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');


/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
       // 'index_file' => false
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	 'auth'       => MODPATH.'auth',       // Basic authentication
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	 'database'   => MODPATH.'database',   // Database access
	 'image'      => MODPATH.'image',      // Image manipulation
	 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	 'unittest'   => MODPATH.'unittest',   // Unit testing
	 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
/*        'pagination'    => MODPATH.'pagination',
        'orm-mptt'    => MODPATH.'orm-mptt',
        'email'    => MODPATH.'email',*/
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

//if ( ! Route::cache()) {
Route::set('widgets', 'widgets(/<controller>(/<param>))', array('param' => '.+'))
	->defaults(array(
            'action'     => 'index',
            'directory' => 'widgets',
	));

Route::set('auth', '<action>', array('action' => 'login|logout|register'))
	->defaults(array(
                'directory'  => 'index',
		'controller' => 'auth',
	));

Route::set('catalog', 'catalog(/<action>(/c<cat>)(/<id>))')
	->defaults(array(
                'directory'  => 'index',
                'action' => 'index',
		'controller' => 'catalog',
	));

Route::set('contacts', 'page/contacts')
	->defaults(array(
                'directory'  => 'index',
                'action' => 'contacts',
		'controller' => 'page',
	));
Route::set('page', 'page(/<page_alias>)')
	->defaults(array(
                'directory'  => 'index',
                'action' => 'index',
		'controller' => 'page',
	));

Route::set('search', 'search')
	->defaults(array(
                'directory'  => 'index',
		'controller' => 'search',
	));

Route::set('admin', 'admin(/<controller>(/<action>(/page<page>)(/<id>)))')
	->defaults(array(
            'directory'  => 'admin',
            'controller' => 'main',
            'action'     => 'index',
	));


Route::set('default', '(<controller>(/<action>(/page<page>)(/<id>)))')
	->defaults(array(
                'directory'  => 'index',
		'controller' => 'main',
		'action'     => 'index',
	));
//Route::cache(TRUE);
//}