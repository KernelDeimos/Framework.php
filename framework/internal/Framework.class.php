<?php
class Framework {
    static $typeMode = "strict";
    static function stackTrace() {
        $stack = debug_backtrace();
        $output = 'Stack trace:' . PHP_EOL;
     
        $stackLen = count($stack);
        for ($i = 1; $i < $stackLen; $i++) {
            $entry = $stack[$i];
     
            $func = $entry['function'] . '(';
            $argsLen = count($entry['args']);
            for ($j = 0; $j < $argsLen; $j++) {
                $func .= $entry['args'][$j];
                if ($j < $argsLen - 1) $func .= ', ';
            }
            $func .= ')';
     
            $output .= '#' . ($i - 1) . ' ' . $entry['file'] . ':' . $entry['line'] . ' - ' . $func . PHP_EOL;
        }
     
        return $output;
    }
    static function TypeMode($mode) {
        Framework::$typeMode = $mode;
    }
    static function AssertType(&$variable, $type, $typeName = false) {
        if ($typeName === false) $typeName = $type;
        if (Framework::$typeMode === "strict") {
            if ( !(gettype($variable) === $type) ) {
                FrameworkException::throw_datatype_exception(VarTools::what_is($variable), $typeName);
            }
        } else {
            $variable = settype($variable, $type);
        }
    }
    static function AssertClass($variable, $name) {
        $what_should_be = "object (".$name.")";
        Framework::AssertType($variable,'object',$what_should_be);
        if ( !(get_class($variable) === $name) ) {
            FrameworkException::throw_datatype_exception(VarTools::what_is($variable), $what_should_be);
        }
    }
}
