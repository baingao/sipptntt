<?php
// konfigurasi built type
// DEBUG atau RELEASE
define('BUILD', "DEBUG");

// konfigurasi database
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbsipptweb');

// konfigurasi path
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

// batasan tahun untuk selection tanggal
define('TAHUN_MULAI', 1940);
define('TAHUN_SELESAI', 2030);

// delimiter untuk data di submit_insert.php & submit_update.php
// kalau ganti di sini, ganti juga di ajax_form_handler.js
// karakter yang aneh-aneh seperti #@$%^&* jangan dipakai
define('ARRAY_DELIMITER', '|');
define('KEY_DELIMITER', "<K>");
define('VALUE_DELIMITER',"<V>");