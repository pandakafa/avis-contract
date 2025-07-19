<?php

session_start();

define( "VERSION", "v1.0" );

global $root;
global $subRoot;

$domain  = 'https://faturapanelhizmetimiz.tr';
$subRoot = '';
$root    = $domain . $subRoot;

if ( empty($_SESSION['token']) ) {
    $_SESSION['token'] = bin2hex( random_bytes( 32 ) );
}

date_default_timezone_set( 'Europe/Istanbul' );

global $db;

$dbHost     = 'localhost';
$dbName     = 'faturapa_yen';
$dbUser     = 'faturapa_yen';
$dbPassword = 'faturapa_yen';
$charSet    = 'utf8';

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$charSet";

$options = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT         => false,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

try {
    $db = new PDO( $dsn, $dbUser, $dbPassword, $options );
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
    echo 'Error DB Connection: ' . $e->getMessage();
    exit;
}

include '_functions.php';