<?php
header('content-type:text/plain; charset=utf-8');

require_once('../functions/pdo_connect.php');
require_once('../define/define.php');
require_once('../callback.php');

// Hydrating and check if this Supplier is in Data Base
extract($_GET);

$id = htmlentities(addslashes($_GET['id_dom']));
$mode = 1;
$table_dom = domaine;
$table_souDom = sous_domaine;
$table_compte = compte_charge;
$table_Scompte = sous_cmpte_chr;

$data = array(
    'champs' => $table_souDom.".LIBELLE",
    'table' => $table_souDom.",".$table_dom.", ".$table_compte.", ".$table_Scompte,
    'where' => $table_souDom.".ID_DOM_A = ".$table_dom.".ID_DOM_A
        AND ".$table_compte.".ID_COMPTE_CHR = ".$table_Scompte.".ID_COMPTE_CHR
        AND ".$table_compte.".ID_COMPTE_CHR = ".$table_dom.".ID_COMPTE_CHR
        AND ".$table_compte.".ID_COMPTE_CHR = ".$table_souDom.".ID_COMPTE_CHR
        AND ".$table_Scompte.".ID_S_COMPTE = ".$table_souDom.".ID_S_COMPTE
        AND ".$table_souDom.".ID_DOM_A = :id
        AND ".$table_souDom.".MODE = :mode",
    'tri' => " "
);
$bind = array(':id' =>$id,':mode' => $mode);
$checking = array($data, $bind);

$json = new Manager($bdd);
$detail = $json->details_domaine($checking);

echo $detail;
?>