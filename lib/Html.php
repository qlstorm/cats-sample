<?php

namespace lib;

class Html {

    public static function options($options, $name) {
        foreach ($options as $key => $value) {
            $selected = '';

            if (isset($_GET[$name]) && $key == $_GET[$name] && strlen($_GET[$name])) {
                $selected = 'selected';
            }

            echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }
    }

    public static function value($name, $stack = [], $default = '') {
        if ($stack) {
            if (isset($stack[$name])) {
                return $stack[$name];
            }

            return;
        }

        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        if ($default) {
            return $default;
        }
    }

    public static function checked($name, $stack, $default = 'checked') {
        if (array_key_exists($name, $stack)) {
            if ($stack[$name]) {
                return 'checked';
            }

            return;
        }

        if ($default) {
            return $default;
        }
    }
}
