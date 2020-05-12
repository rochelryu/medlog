<?php
ini_set('default_charset', 'utf-8');
setlocale (LC_TIME, 'fr_FR.utf8','fra');
require_once('functions/pdo_connect.php');
require_once('define/define.php');
require_once('functions/function.traitement.php');
require_once('functions/encode_utf8.php');
require_once('functions/extension.php');
require_once('callback.php');

if (!isset($_SESSION)) {
	session_start();
}

$supplier = new Fourniss($bdd);
$manager = new Manager($bdd);

$supplier->deconnexion();
