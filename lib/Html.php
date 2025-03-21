<?php

namespace lib;

class Html {

    public static function options($options, $name) {
        foreach ($options as $key => $value) {
            if (isset($_GET[$name]) && $key == $_GET[$name] && strlen($_GET[$name])) {
                echo '<option value="' . $key . '" selected>' . $value . '</option>';
            } else {
                echo '<option value="' . $key . '">' . $value . '</option>';
            }
        }
    }
}
