<?php

function issetor(&$var, $default = FALSE)
{
	return isset($var)? $var : $default;
}
function do_nothing() {
	return;
}

class FrameworkException extends Exception {
	const AUTOLOAD = 0;

	const PATH_HANDLER = 1;
	const PATH_HANDLER_INEXISTANT_PATH_INCLUSION = 1.1;
	const PATH_HANDLER_ONLY_PATH_REMOVAL = 1.2;

	const CONFIG = 3;
	const CONFIG_MISSING_KEY = 3.1;
	const CONFIG_INVALID_TYPE = 3.2;
	const CONFIG_INVALID = 3.3; // invalid configuration object

	const CONTROLLER = 4;
	const CONTROLLER_NOT_FOUND = 4.1;

	const DATATYPE = 5;

	const ASSERTION = 6;

	static function throw_datatype_exception($got, $expected, $test=false) {
		throw new FrameworkException(MiscTools::get_calling_class().": Expecting '".$expected."', got '".$got."'", self::DATATYPE);
	}
	static function assert($boolean, $msg="None given") {
		if (!$boolean) {
			throw new FrameworkException(MiscTools::get_calling_class().": Assertion failed! Additional info: ".$msg, self::ASSERTON);
		}
	}
}

class GeneralPurposeException extends Exception {
  /* For your convenient use, dear developer */
}
