<?php

// Replace all dash with space
function replace_dashes($string){
    $string = str_replace("-", " ", $string);

    return $string;
}

// Replace all space with dash
function replace_spaces($string){
    $string = str_replace(" ", "-", $string);

    return $string;
}

// Returns the file name, less the extension.
function file_ext_strip($filename){
    $filename = preg_replace('/.[^.]*$/', '', $filename);

    return $filename;
}