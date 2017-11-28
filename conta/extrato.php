<?php
require_once "../config/config.php";
$conta = new ContaController('Extrato - Teste Hotmilhas');
$conta->extrato($conta->getRequest('id'));
