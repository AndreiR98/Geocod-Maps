<?php
error_reporting(E_ALL ^ E_NOTICE);


define('PATH', str_replace(PATH_SEPARATOR, '/', dirname(__FILE__)));

function Autoloader($class_name){
	$root = PATH."/lib/";
	$search_dirs = array(
		'{name}.php',
		'{name}.class.php',
		'class/{name}.class.php',
		'class/{name}.class.php',
		'smarty/{name}.class.php',
	);
	foreach($search_dirs as $dir){
		$dir = str_replace('{name}', $class_name, $dir);
		if(file_exists($root.$dir)){
			require_once($root.$dir);
			break;
		}
	}
}

spl_autoload_register('Autoloader');

$tpl = new Geocode_Smarty();
?>