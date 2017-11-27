<?php
require_once "../config/config.php";
$usuario = new UsuarioController('Usuários - Teste Hotmilhas');
$usuario->excluir($usuario->getRequest('id'));
