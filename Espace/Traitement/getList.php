<?php
/**
 * Created by PhpStorm.
 * User: ZEN
 * Date: 11/05/2016
 * Time: 17:52
 */

header('content-type:text/json; charset=utf-8');

require_once('../../functions/pdo_connect.php');
require_once('../../define/define.php');
require_once('../../functions/encode_utf8.php');
require_once('../../functions/extension.php');
// Needing class
require_once('../../php/class/Mysql_query.class.php');
require_once('../../php/class/Fourniss.class.php');
require_once('../../php/class/Manager.class.php');
// Fin

require_once('../../functions/function.traitement.php');

extract($_GET);
$reponse = array();
$res = '';
$table = "";
$agree = (isset($_GET['fr4t']) ? htmlentities(addslashes($_GET['fr4t'])) : '');
$type = (isset($_GET['type']) ? htmlentities(addslashes($_GET['type'])) : '');
$mode = 1;
    if($type == 'clause'){

          $table = clause;

        $query2 = $bdd->prepare("SELECT ID_CLOSE, CODE_CL, LIBELLE, ETAT, DATE_CLAUSE ,DATE_CHARGE
                                  FROM " . $table . "
                                  WHERE ID_AGRE = :agree
                                  AND MODE = :mode");
        $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
        $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query2->execute();
        $rowCount2 = $query2->rowCount();
            if ($rowCount2 > 0) {
                $datas = $query2->fetchAll(PDO::FETCH_BOTH);
                foreach ($datas as $value) {

                    $reponse['data'][] = array(
                        'id' => $value[0],
                        'code' => "<b>".$value[1]."</b>",
                        'libelle' => $value[2],
                        'etat' => ($value[3] == 0) ? '<span class="badge alert-danger"><i class="fa fa-eye-slash"></i> Non charger</span>' : '<span class="badge alert-success"><i class="fa fa-upload"></i> Clause Chargé</span>',
                        'dates' => $value[4],
                        'dateU' => (!empty($value[5])) ? "<span class='text-success'>".$value[5]." </span>" : "<span class='text-warning'>En attente de chargement </span>",

                    );
                }
            }
        $query2->closeCursor();
    }
    elseif ($type == 'contrat'){
        $table = contrat;

        $query2 = $bdd->prepare("SELECT ID_CONTRAT, CODE, LIBELLE, ETAT, DATE_DEBUT ,DATE_CHARGE
                                  FROM " . $table . "
                                  WHERE ID_AGRE = :agree
                                  AND MODE = :mode");
        $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
        $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query2->execute();
        $rowCount2 = $query2->rowCount();
        if ($rowCount2 > 0) {
            $datas = $query2->fetchAll(PDO::FETCH_BOTH);
            foreach ($datas as $value) {

                $reponse['data'][] = array(
                    'id' => $value[0],
                    'code' => "<b>".$value[1]."</b>",
                    'libelle' => $value[2],
                    'etat' => ($value[3] == 0) ? '<span class="badge alert-danger"><i class="fa fa-eye-slash"></i> Non charger</span>' : '<span class="badge alert-success"><i class="fa fa-upload"></i> Clause Chargé</span>',
                    'dates' => $value[4],
                    'dateU' => (!empty($value[5])) ? "<span class='text-success'>".$value[5]." </span>" : "<span class='text-warning'>En attente de chargement </span>",

                );
            }
        }
        $query2->closeCursor();
    }
    elseif ($type == 'avenant'){
        $table = avenant;

        $query2 = $bdd->prepare("SELECT ID_AVENANT, CODE, LIBELLE, ETAT, DATE_DEBUT ,DATE_CHARGE
                                  FROM " . $table . "
                                  WHERE ID_AGRE = :agree
                                  AND MODE = :mode");
        $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
        $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query2->execute();
        $rowCount2 = $query2->rowCount();
        if ($rowCount2 > 0) {
            $datas = $query2->fetchAll(PDO::FETCH_BOTH);
            foreach ($datas as $value) {

                $reponse['data'][] = array(
                    'id' => $value[0],
                    'code' => "<b>".$value[1]."</b>",
                    'libelle' => $value[2],
                    'etat' => ($value[3] == 0) ? '<span class="badge alert-danger"><i class="fa fa-eye-slash"></i> Non charger</span>' : '<span class="badge alert-success"><i class="fa fa-upload"></i> Clause Chargé</span>',
                    'dates' => $value[4],
                    'dateU' => (!empty($value[5])) ? "<span class='text-success'>".$value[5]." </span>" : "<span class='text-warning'>En attente de chargement </span>",

                );
            }
        }
        $query2->closeCursor();
    }
    elseif ($type == 'catalogue'){
        $table = catalogue;

        $query2 = $bdd->prepare("SELECT ID_CAT_FRS, CODE_CAT, TITRE, AUTORISER, CREER_LE ,MODIFIER_LE
                                  FROM " . $table . "
                                  WHERE ID_CMPT = :agree
                                  AND MODE = :mode");
        $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
        $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query2->execute();
        $rowCount2 = $query2->rowCount();
        if ($rowCount2 > 0) {
            $datas = $query2->fetchAll(PDO::FETCH_BOTH);
            foreach ($datas as $value) {

                $reponse['data'][] = array(
                    'id' => $value[0],
                    'code' => "<b>".$value[1]."</b>",
                    'titre' => $value[2],
                    'Autorize' => $value[3],
                    'etat' => ($value[3] == 0) ? '<span class="badge alert-danger"><i class="fa fa-eye-slash"></i> Non Autorisé</span>' : '<span class="badge alert-success"><i class="fa fa-upload"></i> Autorisé</span>',
                    'datesC' => $value[4],
                    'datesM' => (!empty($value[5])) ? "<span class='text-success'>".$value[5]." </span>" : "<span class='text-warning'>Mise à jour non effectuable </span>",

                );
            }
        }
        $query2->closeCursor();
    }
    elseif ($type == 'facture'){
        $table = bc;

        $query2 = $bdd->prepare("SELECT ID_BC, CODE, IMP_ANAL, CATEGORIE, MONTANT_TTC, DATE_BC ,DATE_LIV
                                  FROM " . $table . "
                                  WHERE ID_AGRE = :agree
                                  AND CONFIRMER = :conf
                                  AND MODE = :mode");
        $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
        $query2->bindParam(':conf', $mode, PDO::PARAM_INT);
        $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query2->execute();
        $rowCount2 = $query2->rowCount();
        if ($rowCount2 > 0) {
            $datas = $query2->fetchAll(PDO::FETCH_BOTH);
            foreach ($datas as $value) {

                $reponse['data'][] = array(
                    'id' => $value[0],
                    'code' => "<b>".$value[1]."</b>",
                    'imp' => "<b>".$value[2]."</b>",
                    'cat' => "<b><span class='text-primary'>".$value[3]."</span></b>",
                    'ttc' => number_format($value[4],0, '', ' ')." Frs",
                    'dates' => $value[5],
                    'dateL' => "<span class='badge alert-danger'>".$value[6]."</span>",

                );
            }
        }
        $query2->closeCursor();

    }

print json_encode($reponse , JSON_NUMERIC_CHECK);
?>
