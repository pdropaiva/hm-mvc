<?php
require_once "../config/config.php";
$conta = new ContaController('Editar Conta - Teste Hotmilhas');
if($conta->getMethod() == 'GET') {

    $conta->edita($conta->getRequest('id'));
} else {

    $conta->salva($conta->getRequest('id'));
}
