<?php
require_once "../config/config.php";
$conta = new ContaController('Transferência - Teste Hotmilhas');
if($conta->getMethod() == 'GET') {

    $conta->transferencia($conta->getRequest('conta_id'), $conta->getRequest('id'));
} else {

    $conta->efetuaTransferencia($conta->getRequest('conta_id'), $conta->getRequest('id'));
}
