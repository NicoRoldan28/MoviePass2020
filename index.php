<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

//	require_once(VIEWS_PATH."Facebook/src/Facebook/autoload.php");

	//require_once __DIR__ . '/Facebook/src/Facebook/autoload.php';
	//$loginUrl = $helper->getLoginUrl('http://localhost/MoviePass2020/loginFacebook.php', $permissions);
	
	//$fb = nuevo Facebook \ Facebook ([ 'app_id' => '{app-id}' , 'app_secret' => '{app-secret}' , 'default_graph_version' => 'v2.3' , //. . ]);
	/*$fb = new Facebook\Facebook([
		'app_id' => '355702065636406',
		'app_secret' => 'c3140716d1860625b2eacb4736eafa46',
		'default_graph_version' => 'v2.4',
	  ]);*/

		/* Debemos modificar segun el directorio de instalación*/
	

	require_once(VIEWS_PATH."header.php");

	Router::Route(new Request());

	//require_once(VIEWS_PATH.'ticket-list.php');
?>