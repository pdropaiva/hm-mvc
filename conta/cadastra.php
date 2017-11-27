<?php
require_once "../config/config.php";
$conta = new ContaController('Cadastra Conta - Teste Hotmilhas');
if($conta->getMethod() == 'GET') {

    $conta->cadastra();
} else {

    $conta->salva();
}
