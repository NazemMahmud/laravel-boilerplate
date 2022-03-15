<?php

if (!function_exists('pretty_dump')) {
    function pretty_dump($value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
}
