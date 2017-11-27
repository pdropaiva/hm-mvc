<?php
require_once "../config/config.php";
$usuario = new UsuarioController('Editar Usuário - Teste Hotmilhas');
if($usuario->getMethod() == 'GET') {

    $usuario->edita($usuario->getRequest('id'));
} else {

    $usuario->salva($usuario->getRequest('id'));
}
