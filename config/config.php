<?php
/**
 * Configuração geral
 */

// Caminho para a raiz
define( 'BASE_PATH', str_replace('/config', '', dirname( __FILE__ )) );

// Caminho para a raiz
define( 'CONFIG_PATH', dirname( __FILE__ ));

// Caminho para a raiz
define( 'VIEW_PATH', BASE_PATH.'/views' );

// URL da home
define( 'HOME_URI', 'http://localhost/hm-mvc' );

// Nome do host da base de dados
define( 'HOSTNAME', 'localhost' );

// Nome do DB
define( 'DB_NAME', 'hotmilhas' );

// Usuário do DB
define( 'DB_USER', 'hotmilhas' );

// Senha do DB
define( 'DB_PASSWORD', 'hotmilhas' );

// Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );

// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );

require_once CONFIG_PATH . '/loader.php';
