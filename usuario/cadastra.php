<?php
require_once "../config/config.php";
$usuario = new UsuarioController('Cadastra Usuário - Teste Hotmilhas');
if($usuario->getMethod() == 'GET') {

    $usuario->cadastra();
} else {

    $usuario->salva();
}
