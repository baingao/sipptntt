<?php
/**
 * Database configuration
 */
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbsippt');
define('TAHUN_MULAI', 2014);
define('TAHUN_SELESAI', 2018);
define('HOST', 'http://localhost/crud');

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'crud');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'includes');
defined('CLASSES_PATH') ? null : define('CLASSES_PATH', SITE_ROOT.DS.'includes' . DS. 'classes');
defined('FUNCTIONS_PATH') ? null : define('FUNCTIONS_PATH', SITE_ROOT.DS.'includes' . DS. 'functions');
defined('HELPERS_PATH') ? null : define('HELPERS_PATH', SITE_ROOT.DS.'includes' . DS . 'helpers');

defined('JS_PATH') ? null : define('JS_PATH', HOST.DS.'public' . DS. 'js');
defined('CSS_PATH') ? null : define('CSS_PATH', HOST.DS.'public' . DS. 'css');
defined('FONTS_PATH') ? null : define('FONTS_PATH', HOST.DS.'public' . DS. 'fonts');