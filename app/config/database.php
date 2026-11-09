<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group  = 'default';
$query_builder = true;

// Detección automática de entorno: Local (XAMPP) vs Producción (Hostinger)
$is_local = (
    (isset($_SERVER['SERVER_NAME']) && in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'])) ||
    (isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false)) ||
    (php_sapi_name() === 'cli' && empty($_SERVER['HTTP_HOST']))
);

if ($is_local) {
    // Entorno Local (XAMPP / PC)
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'u646234231_cristal_gus';
} else {
    // Entorno Producción (Hostinger)
    $db_user = 'u646234231_shop_master';
    $db_pass = 'Yaracuy15/*';
    $db_name = 'u646234231_shop_master';
}

$db['default'] = [
    'dsn'          => '',
    'hostname'     => 'localhost',
    'username'     => $db_user,
    'password'     => $db_pass,
    'database'     => $db_name,
    'dbdriver'     => 'mysqli',
    'dbprefix'     => 'sma_',
    'pconnect'     => false,
    'db_debug'     => false,
    'cache_on'     => false,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => false,
    'compress'     => false,
    'stricton'     => false,
    'failover'     => [],
    'save_queries' => false,
];
