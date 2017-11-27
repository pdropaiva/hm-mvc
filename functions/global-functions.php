<?php

function getSession($key) {
    if(!isset($_SESSION[$key])) return null;

    return $_SESSION[$key];
}

function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

function forgetSession($key) {
    unset($_SESSION[$key]);
}

function __autoload($classname) {
    $filename = BASE_PATH."/controllers/". $classname .".php";

    if(file_exists($filename)) {

        include_once($filename);
    } else {

        $filename = BASE_PATH."/models/". $classname .".php";

        if(file_exists($filename)) {

            include_once($filename);
        }
    }

}
