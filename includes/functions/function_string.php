<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getStringBetween($input_string, $start_marker, $end_marker) {
    $input_string = ' ' . $input_string;
    $ini = strpos($input_string, $start_marker);
    if ($ini == 0)
        return '';
    $ini += strlen($start_marker);
    $len = strpos($input_string, $end_marker, $ini) - $ini;
    return substr($input_string, $ini, $len);
}

function isInString($fullstring, $string_to_find) {
    if (strpos($fullstring, $string_to_find) !== false) {
        return true;
    } else {
        return false;
    }
}
