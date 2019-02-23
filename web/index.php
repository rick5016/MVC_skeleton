<?php

error_reporting(E_ALL & ~ E_NOTICE);
ini_set('display_errors', 1);
date_default_timezone_set('CET');

// home page
define('ROOT_HOME', '/home');
// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/index.php')));
// defindes the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));

// starts the session
session_start();

// includes the system routes. Define your own routes in this file
include(ROOT_PATH . '/config/routes.php');

require_once ROOT_PATH . '/vendor/autoload.php'; // your libraries
require_once ROOT_PATH . '/form/autoload.php'; // forms elements
require_once ROOT_PATH . '/modeles/autoload.php'; // entities & repositories
require_once ROOT_PATH . '/library/mvc/autoload.php'; // your ctrl & forms & Twig plugins

// activates the autoloader
Form_Autoloader::register();
ORM_Autoloader::register();
spl_autoload_register('autoloader');

// TODO
unset($_SESSION['query']);

$router = new Router($routes);
$router->execute();
