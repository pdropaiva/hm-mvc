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

function formataDataBanco($data) {

    $dt = explode('/', $data);

    return $dt[2].'-'.$dt[1].'-'.$dt[0];
}

function formataValor($valor) {

    return str_replace(',', '.', str_replace('.', '', $valor));
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
