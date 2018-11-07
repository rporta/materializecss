<?php
/*---------------------------------------------------*/	
function xbug($arg,$arg2 = false){
	$arg3 = str_repeat("-", 60);
	echo "<pre style='color:#00ff00; background-color:black;' >\n";
	echo "\n";
	echo "<".$arg3."\tIn\t".$arg3.">\n";	
	if(is_array($arg) || is_object($arg)){
		if($arg2 == true){
			print_r(var_dump($arg));
		}
		else{
			print_r($arg);
		}
	}
	else{
		if($arg2 == true){
			var_dump($arg);
		}
		else{
			echo $arg."\n";
		}
	}
	echo "<".$arg3."\tOut\t".$arg3.">\n";
	echo "\n";
	echo "</pre>";
}
/*---------------------------------------------------*/	

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read https://symfony.com/doc/current/setup.html#checking-symfony-application-configuration-and-setup
// for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'], true) || PHP_SAPI === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require __DIR__.'/../vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
