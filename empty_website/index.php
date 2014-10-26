<?php
define('DEV_MODE', true);
include("../framework/framework.php");
function mainf() {
	// Setup the framework's autoloader
	IncludePathHandler::add_include_path(SITE_PATH."/lib");
	//framework_load_paths(); - now called by inclusion

	// Setup some toools for this website
	$dbConfig = new Configurator();
	$dbConfig->set_from_ini_file(SITE_PATH."/conf/database.ini");
	$tool_database = new DBConnectionManager($dbConfig);

	// Instanciate a router object.
	$router = new Router();
	/*
	The router class will find and load PHP files
	the way a typical MVC framework does.
	*/
	$router->set_route_from_request($_SERVER['QUERY_STRING']);
	$controller = $router->get_controller(SITE_PATH."/controllers");

	if ($controller === false) { // 404 Page
		$router->set_route_from_request("404");
		$controller = $router->get_controller(SITE_PATH."/errors");
		$controller->run();
	} else {
		$controller->add_tool('con_manager', $tool_database);
		$controller->run();
	}
}

try {
mainf();
} catch (FrameworkException $e) {
	// TODO: Remove exception dump before release, or they'll know too much! ;)
	echo "This is a debugging page; if you're seeing this message, the server is likely undergoing live maintainence.<hr />";
	echo "Error! Framework caught the error detailed below:<br />\n<pre>";
	echo var_dump($e)."</pre>";
} catch (Exception $e) {
	echo "SEVERE ERROR<br />".$e->getMessage();
}
exit();
