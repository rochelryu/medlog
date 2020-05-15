<?php
/**
 * Created by PhpStorm.
 * User: ZEN
 * Date: 23/04/2016
 * Time: 00:45
 */

function sec_session_start() {
    $session_name = 'sec_session_id';   // Attribue un nom de session
    $secure = SECURE;
    // Cette variable empêche Javascript d’accéder à l’id de session
    $httponly = true;
    // Force la session à n’utiliser que les cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        echo '<script>document.location.href = "http://www.portail_fournisseur.com/error.php?err=Could not initiate a safe session (ini_set)";</script>';
       // header("Location: ");
        exit();
    }
    // Récupère les paramètres actuels de cookies
    $cookieParams = session_get_cookie_params();

  session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);

    // Donne à la session le nom configuré plus haut
    session_name($session_name);
    session_start();            // Démarre la session PHP
    session_regenerate_id();    // Génère une nouvelle session et efface la précédente
}

/** Fonction contre la brute Force attack
 * @param $user_id
 * @param $bdd
 * @return bool
 */
function checkbrute($user_id, $bdd) {
    // Récupère le timestamp actuel
    $now = time();

    // Tous les essais de connexion sont répertoriés pour les 2 dernières heures
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $bdd->prepare("SELECT TIMES 
                             FROM login_attempts
                             WHERE ID_CMPT = :i 
                            AND TIMES > '$valid_attempts'")) {
        $stmt->bindParam('i', $user_id,PDO::PARAM_INT);

        // Exécute la déclaration.
        $stmt->execute();
        //$stmt->fetchAll(PDO::FETCH_NUM);

        // S’il y a eu plus de 5 essais de connexion
        if ($stmt->rowCount() > 5) {
            return true;
        } else {
            return false;
        }
    }
}


function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // Nous ne voulons que les liens relatifs de $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

/**
 * @return array Just add any required MIME type if you are going to download something not listed here
 */
function mimeTypes()
{

    $mime_types = array(
        "doc" => "application/msword",
        "dot" => "application/msword",
        "docx" => "application/msword",
        "pdf" => "application/pdf",
        "xla" => "application/vnd.ms‐excel",
        "xlc" => "application/vnd.ms‐excel",
        "xlm" => "application/vnd.ms‐excel",
        "xls" => "application/vnd.ms‐excel",
        "xlt" => "application/vnd.ms‐excel",
        "xlw" => "application/vnd.ms‐excel",
        "xlsx" => "application/vnd.ms‐excel",
        "xlw" => "x‐world/x‐vrml",
    );
    return $mime_types;
}

/**
 * Mon rewrite url
 * @param $lien
 * @param $param
 * @param $key
 * @return array
 *
 */
function rewriteGetVar ($lien, $param, $key){
   $varGet = "";
    $var = 0;

    if($param == 1){

    $Alllab = htmlentities(addslashes($lien));

    // Construct all get var get is lab=var&q=var2
    $lab = substr($Alllab, 0, 128);
    // cut variable
    $decom = explode($lab,$_GET['lab']);
    // get secaond var
    $Qhash = substr($decom[1], 0, 128);
    // check if this are equalities rewrite get variable
    $varGet = ($Qhash == hash('sha512', 'q=' . $key)) ? 'numId=' : '';
    //get variable who as send
    $var = substr($decom[1], -1, 128);
    // new get var
    }
    $tab = array('directory' => $lab, 'chaine' => '?'.$varGet, 'var' => $var);
    return $tab;
}

// La fonction en question.
function suppressionFile($dossier_traite , $ancienDoc,$ancien_extension)
{
// On ouvre le dossier.
    $repertoire = opendir($dossier_traite);

// On lance notre boucle qui lira les fichiers un par un.
    while(false !== ($fichier = readdir($repertoire)))
    {
        // On met le chemin du fichier dans une variable simple
        $chemin = $dossier_traite.$fichier;

        // Les variables qui contiennent toutes les infos nécessaires.
        $infos = pathinfo($chemin);
        $extension = $infos['extension'];
        $basename = $infos['basename'];




// On n'oublie pas LA condition sous peine d'avoir quelques surprises. :p
        if($fichier!="." && $fichier!=".." && !is_dir($fichier) &&
        $extension == $ancien_extension && $ancienDoc == $basename)
                {
                    unlink($chemin);
                }
        }
    closedir($repertoire); // On ferme !
}

/**
 * Verifie si la date de colture est toujours valable
 * @param $cloture
 * @return bool
 */
function validite_date($cloture){

    $datejour = date('d/m/Y');
    $datefin= $cloture;
    $dfin = explode("/", $datefin);
    if(isset($dfin[1], $dfin[2])){

    $djour = explode("/", $datejour);
    $finab = $dfin[2].$dfin[1].$dfin[0];
    $auj = $djour[2].$djour[1].$djour[0];

    if ($auj>$finab){
        return true;
    }else{
        return false;
    }
    }else{
        return false;
    }
}


/**
 * @param $table
 * @param $table2
 * @param $patch
 * @param $files
 * @param $ddb
 * @return array
 */
function import_grille($type_o, $agree, $appel, $patch, $files,$bdd){

    /************************ YOUR DATABASE CONNECTION END HERE  ****************************/
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    set_include_path(get_include_path() . PATH_SEPARATOR . ''.$patch.'');
    include ($patch.'PHPExcel/IOFactory.php');

// This is the file path to be uploaded.
    $inputFileName = $files;

    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }


    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

    $retour = "";

    for($i=2;$i<=$arrayCount;$i++){

        if(trim($allDataInSheet[$i]["A"]) != '' && trim($allDataInSheet[$i]["B"]) != '' && trim($allDataInSheet[$i]["C"]) != ''  && trim($allDataInSheet[$i]["D"]) != ''){

            $fnc = (!empty(trim($allDataInSheet[$i]["B"])) ? trim($allDataInSheet[$i]["B"]) : '');
            $crt = (!empty(trim($allDataInSheet[$i]["C"])) ? trim($allDataInSheet[$i]["C"]) : '');
            $cota = (!empty(trim($allDataInSheet[$i]["D"])) ? trim($allDataInSheet[$i]["D"]) : '');

            if ($type_o == 1) {
                $tableG = grille_cot_std;

                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_STD =:fnc AND ID_CRT_STD =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

               if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_STD, ID_CRT_STD, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                   $valid->bindValue(5, $cota,PDO::PARAM_INT);
                   $valid->bindValue(6,$date ,PDO::PARAM_STR);
                   $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }
            elseif ($type_o == 2) {
                $tableG = grille_cot_pi;
                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_PI =:fnc AND ID_CRT_PI =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_PI, ID_CRT_PI, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                    $valid->bindValue(5, $cota,PDO::PARAM_INT);
                    $valid->bindValue(6,$date ,PDO::PARAM_STR);
                    $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }
            elseif ($type_o == 3) {
                $tableG = grille_cot_imp;
                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_IMP =:fnc AND ID_CRT_IMP =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_IMP, ID_CRT_IMP, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                    $valid->bindValue(5, $cota,PDO::PARAM_INT);
                    $valid->bindValue(6,$date ,PDO::PARAM_STR);
                    $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }
            elseif ($type_o == 4) {
                $tableG = grille_cot_prj;
                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_PRJ =:fnc AND ID_CRT_PRJ =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_PRJ, ID_CRT_PRJ, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                    $valid->bindValue(5, $cota,PDO::PARAM_INT);
                    $valid->bindValue(6,$date ,PDO::PARAM_STR);
                    $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }
            elseif ($type_o == 5) {
                $tableG = grille_cot_btp;
                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_BTP =:fnc AND ID_CRT_BTP =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_BTP, ID_CRT_BTP, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                    $valid->bindValue(5, $cota,PDO::PARAM_INT);
                    $valid->bindValue(6,$date ,PDO::PARAM_STR);
                    $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }
            elseif ($type_o == 6) {
                $tableG = grille_cot_sg;
                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$tableG."  WHERE ID_APPEL = :appel AND ID_AGRE = :agree AND ID_FNC_SG =:fnc AND ID_CRT_SG =:ctr AND MODE = :mode");
                $rep->bindParam(':appel',$appel, PDO::PARAM_INT);
                $rep->bindParam(':agree',$agree,PDO::PARAM_INT);
                $rep->bindParam(':fnc',$fnc,PDO::PARAM_INT);
                $rep->bindParam(':ctr',$crt,PDO::PARAM_INT);
                $rep->bindParam(':mode',$mode,PDO::PARAM_INT);

                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$tableG." (ID_APPEL,ID_AGRE, ID_FNC_SG, ID_CRT_SG, COTATION, DATE_COT, MODE) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                    $valid->bindValue(1,$appel,PDO::PARAM_INT);
                    $valid->bindValue(2, $agree, PDO::PARAM_INT);
                    $valid->bindValue(3, $fnc,PDO::PARAM_STR);
                    $valid->bindValue(4,$crt ,PDO::PARAM_INT);
                    $valid->bindValue(5, $cota,PDO::PARAM_INT);
                    $valid->bindValue(6,$date ,PDO::PARAM_STR);
                    $valid->bindValue(7,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $retour = 'ok';
                    }
                }

                unset($valid, $nbr, $rep, $tableG, $fnc, $crt,$cota);
            }

        }

    }
    return $retour;
}

function import_catalogue_art($table1, $id_insert,$method, $patch, $file_art,$bdd){

    /************************ YOUR DATABASE CONNECTION END HERE  ****************************/
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    set_include_path(get_include_path() . PATH_SEPARATOR . ''.$patch.'');
    include ($patch.'PHPExcel/IOFactory.php');

// This is the file path to be uploaded.
    $inputFileName = $file_art;


    try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
    /*
     * Unprotect sheet
     */
    $objPHPExcel->getSecurity()->setLockWindows(false);
    $objPHPExcel->getSecurity()->setLockStructure(false);
    $objPHPExcel->getSecurity()->setWorkbookPassword("zen");
         $newOBJECT = $objPHPExcel->setActiveSheetIndexByName('RECORDS');
    $newOBJECT->getProtection()->setSheet(false);
    $newOBJECT->getProtection()->setSort(false);
    $newOBJECT->getProtection()->setInsertRows(false);
    $newOBJECT->getProtection()->setFormatCells(false);
    $newOBJECT->getProtection()->setPassword('zen');
    $newOBJECT->getProtection()->setSelectLockedCells(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

    $newOBJECT = $objPHPExcel->setActiveSheetIndexByName('RECORDS');
    $arrayCount = $newOBJECT->getHighestRow(); //count($allDataInSheet);  // Here get total count of row in that Excel sheet

    $retour = "";
    $test1 = "";
    $tab = array();
    for($i=2;$i<=$arrayCount;$i++){

        if(trim($newOBJECT->getCellByColumnAndRow(0, $i)) != '' && trim($newOBJECT->getCellByColumnAndRow(1, $i)) != ''
            && trim($newOBJECT->getCellByColumnAndRow(2, $i)) != ''  && trim($newOBJECT->getCellByColumnAndRow(3, $i)) != ''
            && trim($newOBJECT->getCellByColumnAndRow(4, $i)) != ''  && trim($newOBJECT->getCellByColumnAndRow(5, $i)) != ''
            && trim($newOBJECT->getCellByColumnAndRow(6, $i)) != ''  && trim($newOBJECT->getCellByColumnAndRow(7, $i)) != ''
            && trim($newOBJECT->getCellByColumnAndRow(8, $i)) != '' && trim($newOBJECT->getCellByColumnAndRow(9, $i)) != ''
            && trim($newOBJECT->getCellByColumnAndRow(10, $i)) != ''

        ){

            $dom = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(9, $i)->getOldCalculatedValue()));
            $s_dom = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(10, $i)->getOldCalculatedValue()));
            $code = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(2, $i)->getValue()));
            $ref = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(3, $i)->getValue()));
            $design = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(4, $i)->getValue()));
            $date_ref = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(5, $i)->getValue()));
            $delai = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(6, $i)->getValue()));
            $renvPrix = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(7, $i)->getValue()));
            $comd = htmlentities(addslashes($newOBJECT->getCellByColumnAndRow(8, $i)->getValue()));

            if($method == "insertion"){
                $valid = $bdd->prepare("INSERT INTO ".$table1." (ID_CAT_FRS,ID_DOM_A, ID_S_DOM, CODE, REFERENCE, DESIGNATION, DATE_REFER, DELAI_MOY_LIV, DATE_CHANG, COMAND_MIN, CREER_LE, MODIFIER_LE,MODE) 
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
                $valid->bindValue(1,(int)$id_insert,PDO::PARAM_INT);
                $valid->bindValue(2, (int)$dom, PDO::PARAM_INT);
                $valid->bindValue(3, $s_dom,PDO::PARAM_STR);
                $valid->bindValue(4, $code,PDO::PARAM_STR);
                $valid->bindValue(5, $ref,PDO::PARAM_STR);
                $valid->bindValue(6,$design,PDO::PARAM_STR);
                $valid->bindValue(7,$date_ref,PDO::PARAM_STR);
                $valid->bindValue(8,$delai,PDO::PARAM_STR);
                $valid->bindValue(9, $renvPrix, PDO::PARAM_STR);
                $valid->bindValue(10, (int)$comd,PDO::PARAM_INT);
                $valid->bindValue(11, $date,PDO::PARAM_STR);
                $valid->bindValue(12,NULL ,PDO::PARAM_STR);
                $valid->bindValue(13,$mode ,PDO::PARAM_INT);
                $valid->execute();
                $valid->closeCursor();
                if(!empty($valid)) {
                    $test1 = 'ok';
                    $tab[] = $bdd->lastInsertId();
                }

                unset($valid, $dom ,$s_dom, $code, $ref, $design, $date_ref, $delai, $renvPrix ,$comd);
            }
            elseif($method == "updating"){

                $valid = $bdd->prepare("UPDATE ".$table1." SET CODE =?, REFERENCE=?, DESIGNATION=?, DATE_REFER=?, DELAI_MOY_LIV=?, DATE_CHANG=?, COMAND_MIN=?, MODIFIER_LE=?
                                        WHERE ID_CAT_FRS = ? AND ID_DOM_A =? AND ID_S_DOM =? AND MODE = ?");
                $valid->bindValue(1,$code,PDO::PARAM_STR);
                $valid->bindValue(2, $ref,PDO::PARAM_STR);
                $valid->bindValue(3,$design ,PDO::PARAM_STR);
                $valid->bindValue(4,$date_ref,PDO::PARAM_STR);
                $valid->bindValue(5,$delai,PDO::PARAM_STR);
                $valid->bindValue(6, $renvPrix, PDO::PARAM_STR);
                $valid->bindValue(7, (int)$comd,PDO::PARAM_INT);
                $valid->bindValue(8, $date,PDO::PARAM_STR);
                $valid->bindValue(9,(int)$id_insert,PDO::PARAM_INT);
                $valid->bindValue(10, (int)$dom, PDO::PARAM_INT);
                $valid->bindValue(11, $s_dom,PDO::PARAM_STR);
                $valid->bindValue(12, $mode ,PDO::PARAM_STR);

                $valid->execute();
                $valid->closeCursor();
                if(!empty($valid)) {
                    $test1 = 'ok';
                    $tab[] = array();
                }

                unset($valid, $dom ,$s_dom, $code, $ref, $design, $date_ref, $delai, $renvPrix ,$comd);
            }

            }



    }
    if(!empty($test1)){$retour = $tab;}
    return $retour;
    //return $arrayCount;
}

function import_catalogue_det($table2, $tab, $method,$file_det,$bdd){

    /************************ YOUR DATABASE CONNECTION END HERE  ****************************/
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
   // set_include_path(get_include_path() . PATH_SEPARATOR . ''.$patch.'');
   // include ($patch.'PHPExcel/IOFactory.php');

// This is the file path to be uploaded.
    $inputFileName = $file_det;

    try {
        $objPHPExcel2 = PHPExcel_IOFactory::load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
   /*
   * Unprotect Sheet
   */
    $objPHPExcel2->getSecurity()->setLockWindows(false);
    $objPHPExcel2->getSecurity()->setLockStructure(false);
    $objPHPExcel2->getSecurity()->setWorkbookPassword("zen");
    $objPHPExcel2->getActiveSheet()->getProtection()->setSheet(false);
    $objPHPExcel2->getActiveSheet()->getProtection()->setSort(false);
    $objPHPExcel2->getActiveSheet()->getProtection()->setInsertRows(false);
    $objPHPExcel2->getActiveSheet()->getProtection()->setFormatCells(false);

    $objPHPExcel2->getActiveSheet()->getProtection()->setPassword('zen');
    $objPHPExcel2->getActiveSheet()->getProtection()->setSelectLockedCells(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

    $allDataInSheet2 = $objPHPExcel2->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount2 = count($allDataInSheet2);  // Here get total count of row in that Excel sheet

//


    $retour = "";
    $test1 = "";

        $k = 0;
        for($j=2;$j<=$arrayCount2;$j++){

            if(trim($allDataInSheet2[$j]["A"]) != '' && trim($allDataInSheet2[$j]["B"]) != ''
                && trim($allDataInSheet2[$j]["C"]) != '' && trim($allDataInSheet2[$j]["D"]) != ''
                && trim($allDataInSheet2[$j]["E"]) != '' && trim($allDataInSheet2[$j]["F"]) != ''
                && trim($allDataInSheet2[$j]["G"]) != '' && trim($allDataInSheet2[$j]["H"]) != ''
                && trim($allDataInSheet2[$j]["I"]) != '' && trim($allDataInSheet2[$j]["J"]) != ''
            ){

                $id_art = $tab[$k];
                $prixB = htmlentities(addslashes($allDataInSheet2[$j]["A"]));
                $prixV = htmlentities(addslashes($allDataInSheet2[$j]["B"]));
                $unite = htmlentities(addslashes($allDataInSheet2[$j]["C"]));
                $qte = htmlentities(addslashes($allDataInSheet2[$j]["D"]));
                $interv = htmlentities(addslashes($allDataInSheet2[$j]["E"]));
                $remise = htmlentities(addslashes($allDataInSheet2[$j]["F"]));
                $tva = htmlentities(addslashes($allDataInSheet2[$j]["G"]));
                $Dprix = htmlentities(addslashes($allDataInSheet2[$j]["H"]));
                $caract = htmlentities(addslashes($allDataInSheet2[$j]["I"]));
                $info = htmlentities(addslashes($allDataInSheet2[$j]["J"]));

                if($method == "insertion"){
                    $valid = $bdd->prepare("INSERT INTO ".$table2." (ID_ART_CAT,PRIX_BASE, PRIX_VENTE, UNITE, QTE_DISPO, INTERVAL_REMISE, REMISE, TVA, DERNIER_PRIX, CARACTERISTIQUE, INFORMATION, CREER_LE, MODIFIER_LE,MODE) 
                    VALUES(?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?) ");
                    $valid->bindValue(1,$id_art,PDO::PARAM_INT);
                    $valid->bindValue(2, $prixB, PDO::PARAM_INT);
                    $valid->bindValue(3, $prixV,PDO::PARAM_STR);
                    $valid->bindValue(4, $unite ,PDO::PARAM_STR);
                    $valid->bindValue(5, $qte,PDO::PARAM_INT);
                    $valid->bindValue(6,$interv ,PDO::PARAM_STR);
                    $valid->bindValue(7,$remise,PDO::PARAM_INT);
                    $valid->bindValue(8,$tva,PDO::PARAM_INT);
                    $valid->bindValue(9, $Dprix, PDO::PARAM_STR);
                    $valid->bindValue(10, (string) $caract,PDO::PARAM_STR);
                    $valid->bindValue(11,(string)$info ,PDO::PARAM_STR);
                    $valid->bindValue(12, $date,PDO::PARAM_INT);
                    $valid->bindValue(13,NULL ,PDO::PARAM_STR);
                    $valid->bindValue(14,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $test1 = 'ok';
                        // $tab[] = $bdd->lastInsertId();
                    }

                    unset($valid, $id_art ,$prixB, $prixV ,$unite ,$qte ,$interv ,$remise ,$tva ,$Dprix ,$caract ,$info );
                }
                elseif ($method == "updating"){
                    $valid = $bdd->prepare("UPDATE ".$table2." SET PRIX_BASE =?, PRIX_VENTE=?, UNITE=?, QTE_DISPO=?, INTERVAL_REMISE=?, REMISE=?, TVA=?, DERNIER_PRIX=?, CARACTERISTIQUE=?, INFORMATION=?, MODIFIER_LE=?
                                            WHERE ID_ART_CAT = ? AND MODE = ?");
                    $valid->bindValue(12,$id_art,PDO::PARAM_INT);
                    $valid->bindValue(1, $prixB, PDO::PARAM_INT);
                    $valid->bindValue(2, $prixV,PDO::PARAM_STR);
                    $valid->bindValue(3, $unite ,PDO::PARAM_STR);
                    $valid->bindValue(4, $qte,PDO::PARAM_INT);
                    $valid->bindValue(5,$interv ,PDO::PARAM_STR);
                    $valid->bindValue(6,$remise,PDO::PARAM_INT);
                    $valid->bindValue(7,$tva,PDO::PARAM_INT);
                    $valid->bindValue(8, $Dprix, PDO::PARAM_STR);
                    $valid->bindValue(9, (string) $caract,PDO::PARAM_STR);
                    $valid->bindValue(10,(string)$info ,PDO::PARAM_STR);
                    $valid->bindValue(11,$date ,PDO::PARAM_STR);
                    $valid->bindValue(13,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $test1 = 'ok';
                    }

                    unset($valid, $id_art ,$prixB, $prixV ,$unite ,$qte ,$interv ,$remise ,$tva ,$Dprix ,$caract ,$info );
                }

            }
            $k ++;
        }


    if(!empty($test1)){$retour = 'ok';}
    return $retour;
}

?>