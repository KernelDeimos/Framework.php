<?php

/* Welcome to an example controller in a framework called Framework!
 * This comment can be erased; it's just babbling about how a class works
 *
 * This code looks a bit strange at first glance, so this comment is here
 * to help you out a bit. You see, PHP doesn't have anonymous classes. In
 * Java, for example, anonymous classes can be created for things such as
 * event listeners, so as not to clutter the namespace etc. This would be
 * a very useful feature for something like a page controller, since each
 * controller is a class that implements an interface (called Controller)
 *
 * The Controller class is part of Framework, and it extends the Abstract
 * Class class, called AnonymousClass, and overrides one protected method
 * called get_required_methods(), which is called by the contructor. Then
 * , if an item returned by get_required_methods isn't passed, there will
 * be an exception thrown by the constructor.
 *
 * ^ Sorry for the wordieness. It was too fun trying to make a perfect block.
 *  - Eric
 */

$methods = array();

$methods['run'] = function($instance) {
	$r = $instance->route;
	$home = new Template();
	$home->set_template_file(SITE_PATH.'/templates/home.template.php');

	try {
		$testConnect = $instance->tools['con_manager']->get_connection();
		$home->displayDBSuccess = true;
		$home->displayDBWarning = false;
	} catch (PDOException $e) {
		$home->displayDBSuccess = false;
		$home->displayDBWarning = true;
	}
	$home->run();
};

$page_controller = new Controller($methods);
unset($methods);
/*
$page_controller = new Controller(array(
	'run' => function($instance) {
		$r = $route->get_path_array();
		$home = new Template();
		$home->set_template_file(SITE_PATH.'/templates/home.template.php');

		try {
			$testConnect = $tools['con_manager']->get_connection();
			$home->displayDBSuccess = true;
		} catch (PDOException $e) {
			$home->displayDBWarning = true;
		}
		
		if (VarTools::key_exists_equals(1,$r,"ajax")) {
			$home->run();
		} else {
			$full = $tools['t_fullpage'];
			$full->subTemplate = $home;
			$full->run();
		}
	}
));
*/