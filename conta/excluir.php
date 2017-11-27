<?php
require_once "../config/config.php";
$conta = new ContaController('Contas - Teste Hotmilhas');
$conta->excluir($conta->getRequest('id'));
