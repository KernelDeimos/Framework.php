<?php

function issetor(&$var, $default = FALSE)
{
	return isset($var)? $var : $default;
}