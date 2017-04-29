<?php

if (!function_exists('classNames')) {
    function classNames()
    {
        $args = func_get_args();

        $data = array_reduce($args, function ($carry, $arg) {
            if (is_array($arg)) {
                return array_merge($carry, $arg);
            }

            $carry[] = $arg;
            return $carry;
        }, []);

        $classes = array_map(function ($key, $value) {
            $condition = $value;
            $return = $key;

            if (is_int($key)) {
                $condition = null;
                $return = $value;
            }

            $isArray = is_array($return);
            $isObject = is_object($return);
            $isStringableType = !$isArray && !$isObject;

            $isStringableObject = $isObject && method_exists($return, '__toString');

            if (!$isStringableType && !$isStringableObject) {
                return null;
            }

            if ($condition === null) {
                return $return;
            }

            return $condition ? $return : null;

        }, array_keys($data), array_values($data));

        $classes = array_filter($classes);

        return implode(' ', $classes);
    }
}
