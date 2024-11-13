<?php
 namespace  core;
class Validator {
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);

        if (is_string($value) && strlen($value) >= $min && strlen($value) <= $max) {
            return true;
        }
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
