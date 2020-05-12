<?php
/**
 * Created by PhpStorm.
 * User: ZEN
 * Date: 27/04/2016
 * Time: 18:23
 * @lang php
 */
require_once('../../functions/pdo_connect.php');
require_once('../../define/define.php');
require_once('../../functions/function.traitement.php');
require_once('../../functions/encode_utf8.php');
require_once('../../functions/extension.php');
require_once('../../callback.php');
date_default_timezone_set('UTC');
setlocale(LC_TIME, 'fr_FR.UTF8','fra');
    $type = isset($_POST['by']) ? htmlentities(addslashes($_POST['by'])) : '';
    $postId = isset($_POST['postId']) ? htmlentities(addslashes($_POST['postId'])) : '';
    $user = isset($_POST['user']) ? htmlentities(addslashes($_POST['user'])) : '';
    $test = "";
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    $manager = new Manager($bdd);
    $table = "";
        if($type == 'agr'){
            $table = postuler;
        }elseif($type == 'offre'){
            $table = postuler_offr;
        }

    $test = $manager->postuler($bdd, $table, $type, $user, $postId, $date);

    print json_encode(array('result' => $test), JSON_NUMERIC_CHECK);
?>