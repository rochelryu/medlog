<?php

require_once('../../functions/pdo_connect.php');
require_once('../../define/define.php');
require_once('../../functions/function.traitement.php');
require_once('../../functions/encode_utf8.php');
require_once('../../functions/extension.php');
require_once('../../callback.php');
date_default_timezone_set('UTC');
setlocale(LC_TIME, 'fr_FR.UTF8','fra');
   extract($_POST);
    $mode = 1;
   $email = isset($_POST['nf_email']) ? htmlentities(addslashes($_POST['nf_email'])) : '';
   if ($email !== '') {
    $req = $bdd->prepare("INSERT INTO ". newsletters . "(email, mode) VALUES (?, 1)");
    $req->bindValue(1,$email,PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
    $verifData = $req;

    if (!empty($verifData)){
        print json_encode(array('resultat' => 'ok'), JSON_NUMERIC_CHECK);
    }
    elseif (empty($verifData)) {
        print json_encode(array('resultat' => 'none'), JSON_NUMERIC_CHECK);
    }
   } else {
    print json_encode(array('resultat' => 'none'), JSON_NUMERIC_CHECK);
   }