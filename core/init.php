<?php 

	session_start();


	define('application', realpath('./'));


	$paths = array(

		application,
		application.'/classes',
		get_include_path()

	);

	set_include_path(implode(PATH_SEPARATOR, $paths));


	spl_autoload_register(function($class){

		require_once $class.".php";
	});


	$GLOBALS['config'] = array(


		'mysql' => array(

			'host' => 'localhost',
			'dbname' => 'restaurant',
			'user' => 'root',
			'password' => ''

		),

		'session' => array(

			'session_name' => 'user',
			'token_name' => 'token'
		),


		'cookie' => array(

			'cookie_name' => 'hash',
			'cookie_expiry' => 604800

		)

	);