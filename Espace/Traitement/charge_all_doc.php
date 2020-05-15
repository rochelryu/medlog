<?php
//header('content-type:text/json; charset=utf-8');
ini_set('memory_limit', '1024M'); // or you could use 1G
set_time_limit(500);
/**
 * Created by PhpStorm.
 * User: ZEN
 * Date: 11/05/2016
 * Time: 20:19
 * @lang php javascript
 */
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
date_default_timezone_set('UTC');
setlocale(LC_TIME, 'fr_FR.UTF8','fra');
extract($_POST);

$manager = new Manager($bdd);
$query = new Mysql_query($bdd);
$mode = 1;
$type =  htmlentities(addslashes($_POST['type']));
$valide = "";
$format = 'd/m/Y, H:i:s';
$date = date($format);

    if($type == 'clause'){
        $agree = htmlentities(addslashes($_POST['f4t']));
        $id_clause = htmlentities(addslashes($_POST['clt']));

        $directory = "files/files_upload_clause/";
        $content_types_list = mimeTypes();

// Check if DATA ETAT is 1
        $verif_data = array(
            'champs' => "ETAT",
            'table' => clause,
            'where' => "ID_AGRE = :agree AND ID_CLOSE = :clause AND MODE = :mode",
            'tri' => "ORDER BY ID_CLOSE ASC"
        );
        $verif_bind = array(':agree' => $agree, ':clause' => $id_clause, ':mode' => $mode);
        $query->hydrate($verif_data);
        $query->select($verif_bind);
        $verif = $query->getVariable();

        if(count($verif)>0){
            foreach ($verif as $item){
                if ($item[0] == 0){
                    $content_types_list = mimeTypes();
                    $browsing = array('files' => $_FILES["files"],'nbre'=> count($_FILES["files"]),  'doc' => $directory, 'mime' =>$content_types_list);
                    $nameDirec = $manager->uploading($browsing);

                    if(!empty($nameDirec)){
                        // Hydrating and Update if value existe
                        $donnees = array(
                            'table' => clause,
                            'modes' => "PIECE = :piece, ETAT = :etat, DATE_CHARGE = :datesC",
                            'where' => "ID_CLOSE = :idClt AND ID_AGRE = :agre AND MODE = :mode"
                        );
                        $binding = array(':idClt' => $id_clause, ':agre' => $agree, ':piece' => (string)$nameDirec, ':etat' => $mode,':datesC' => $date, ':mode' => $mode);

                        $query->hydrate($donnees);
                        $query->update($binding);
                        $valide = $query->getVariable();
                        unset($query,$donnees, $binding, $verif_data,$verif_bind, $verif );

                    }
                }
            }


    }
    }
    elseif ($type == 'contrat'){
        $agree = htmlentities(addslashes($_POST['f4t']));
        $id_contrat = htmlentities(addslashes($_POST['clt']));

        $directory = "files/files_upload_contrat-annexe/";
        $content_types_list = mimeTypes();

// Check if DATA ETAT is 1
        $verif_data = array(
            'champs' => "ETAT",
            'table' => contrat,
            'where' => "ID_AGRE = :agree AND ID_CONTRAT = :clause AND MODE = :mode",
            'tri' => "ORDER BY ID_CONTRAT ASC"
        );
        $verif_bind = array(':agree' => $agree, ':clause' => $id_contrat, ':mode' => $mode);
        $query->hydrate($verif_data);
        $query->select($verif_bind);
        $verif = $query->getVariable();

        if(count($verif)>0){
            foreach ($verif as $item){
                if ($item[0] == 0){
                    $content_types_list = mimeTypes();
                    // Upload contrat
                    $browsing = array('files' => $_FILES["files"],'nbre'=>count($_FILES["files"]),  'doc' => $directory, 'mime' =>$content_types_list);
                    $nameDocContr = $manager->uploading($browsing);
                    unset($browsing);
                    // Upload annexe
                    $browsing = array('files' => $_FILES["filesA"],'nbre'=>count($_FILES["filesA"]),  'doc' => $directory, 'mime' =>$content_types_list);
                    $nameDocAnx = $manager->uploading($browsing);

                    if(!empty($nameDocContr) && !empty($nameDocAnx)){
                        // Hydrating and Update if value existe
                        $donnees = array(
                            'table' => contrat,
                            'modes' => "PIECE = :piece, ETAT = :etat, DATE_CHARGE = :datesC",
                            'where' => "ID_CONTRAT = :idClt AND ID_AGRE = :agre AND MODE = :mode"
                        );
                        $binding = array(':idClt' => $id_contrat, ':agre' => $agree, ':piece' => (string)$nameDocContr, ':etat' => $mode,':datesC' => $date, ':mode' => $mode);

                        $donnees2 = array(
                            'table' => annex_contrat,
                            'modes' => "PIECE = :piece",
                            'where' => "ID_CONTRAT = :idClt"
                        );
                        $binding2 = array(':idClt' => $id_contrat, ':piece' => (string)$nameDocAnx);

                        // Update contrat zone
                        $query->hydrate($donnees);
                        $query->update($binding);
                        $exec1 = $query->getVariable();
                        // Update Annnexe Zone
                        $query->hydrate($donnees2);
                        $query->update($binding2);
                        $exec2 = $query->getVariable();

                        if(!empty($exec1) && !empty($exec2)){$valide ="valiver";}

                        unset($query,$donnees, $binding, $donnees2, $binding2, $verif_data,$verif_bind, $verif,$exec1, $exec2 );

                    }
                }
            }


        }
    }
    elseif ($type == 'avenant'){
        $agree = htmlentities(addslashes($_POST['f4t']));
        $id_avenant = htmlentities(addslashes($_POST['clt']));

        $directory = "files/files_upload_avenant/";
        $content_types_list = mimeTypes();

// Check if DATA ETAT is 1
        $verif_data = array(
            'champs' => "ETAT",
            'table' => avenant,
            'where' => "ID_AGRE = :agree AND ID_AVENANT = :clause AND MODE = :mode",
            'tri' => "ORDER BY ID_AVENANT ASC"
        );
        $verif_bind = array(':agree' => $agree, ':clause' => $id_avenant, ':mode' => $mode);
        $query->hydrate($verif_data);
        $query->select($verif_bind);
        $verif = $query->getVariable();

        if(count($verif)>0){
            foreach ($verif as $item){
                if ($item[0] == 0){
                    $content_types_list = mimeTypes();
                    $browsing = array('files' => $_FILES["files"],'nbre'=>count($_FILES["files"]),  'doc' => $directory, 'mime' =>$content_types_list);
                    $nameDirec = $manager->uploading($browsing);
                    
                    if(!empty($nameDirec)){
                        // Hydrating and Update if value existe
                        $donnees = array(
                            'table' => avenant,
                            'modes' => "PIECE = :piece, ETAT = :etat, DATE_CHARGE = :datesC",
                            'where' => "ID_AVENANT = :idClt AND ID_AGRE = :agre AND MODE = :mode"
                        );
                        $binding = array(':idClt' => $id_avenant, ':agre' => $agree, ':piece' => (string)$nameDirec, ':etat' => $mode,':datesC' => $date, ':mode' => $mode);

                        $query->hydrate($donnees);
                        $query->update($binding);
                        $valide = $query->getVariable();
                        unset($query,$donnees, $binding, $verif_data,$verif_bind, $verif );

                    }
                }
            }


        }
    }
    elseif ($type == 'catalogue'){
        $group = ((isset($_POST['group'])) && (trim(htmlentities(addslashes($_POST['group']))) == 0)) ? 'create': 'upgrade';
        if($group == 'create'){
            $id_compt = isset($_POST['f4t']) ? htmlentities(addslashes($_POST['f4t'])) : '';
            $dom = isset($_POST['domaine']) ? htmlentities(addslashes($_POST['domaine'])) : '';
            $titre = isset($_POST['titre']) ? char(htmlentities(addslashes($_POST['titre']))) : '';
            $code = isset($_POST['code']) ? htmlentities(addslashes($_POST['code'])) : '';
            $autorise = 0;
            $directory = "files/files_upload_cat/";
            $content_types_list = mimeTypes();

// Check if DATA EXIST
            $verif_data = array(
                'champs' => "ID_CAT_FRS",
                'table' => catalogue,
                'where' => "ID_CMPT = :cmpt AND ID_DOM_A = :dom AND MODE = :mode",
                'tri' => "ORDER BY ID_CAT_FRS ASC"
            );
            $verif_bind = array(':cmpt' => $id_compt, ':dom' => $dom, ':mode' => $mode);
            $query->hydrate($verif_data);
            $query->select($verif_bind);
            $verif = $query->getVariable();

            if(count($verif) == 0) {

                $browsing = array('files' => $_FILES["catalogue"],'nbre'=>count($_FILES["catalogue"]),  'doc' => $directory, 'mime' =>$content_types_list);
                $nameDirec = $manager->uploading($browsing);

                if(!empty($nameDirec)){

                    // Hydrating and Update if value existe
                    $donnees = array(
                        'champs' => "ID_DOM_A ,ID_CMPT ,CODE_CAT ,TITRE, FICHIER ,AUTORISER ,CREER_LE ,MODIFIER_LE ,	MODE",
                        'table' =>  catalogue,
                        'value' => ":dom, :cmpt, :code, :titre, :fichier, :autorise, :creer, :modif, :mode",
                    );
                    $binding = array(':dom' => $dom, ':cmpt' => $id_compt, ':code' => (string)$code, ':titre' => (string)$titre, ':fichier' => (string)$nameDirec, ':autorise' => $autorise, ':creer' => $date, ':modif' => NULL,':mode' => $mode);

                    $query->hydrate($donnees);
                    $query->insert($binding);
                    $id_insert = $query->getLastId();
                    $valid = $query->getVariable();

                        if(!empty($id_insert) && !empty($valid)){
                            $fichier1 = addslashes(htmlentities($_FILES["article"]['name'][0]));
                            $file_art = addslashes(htmlentities($_FILES["article"]['tmp_name'][0]));

                            $fichier2 = addslashes(htmlentities($_FILES["det_article"]['name'][0]));
                            $file_det = addslashes(htmlentities($_FILES["det_article"]['tmp_name'][0]));
                            //---------------------------------------------
                            $ext = get_file_ext($fichier1);      $ext2 = get_file_ext($fichier2);
                            $patch = '../../php/';
                            $method = "insertion";
                            if(array_key_exists($ext, $content_types_list) && array_key_exists($ext2, $content_types_list)) {
                                $table1 = article_cataloguer; $table2 = details_art_cata;
                                $tab = import_catalogue_art($table1, $id_insert,$method, $patch, $file_art,$bdd);
                               if(count($tab)>0){
                                    $valid2 = import_catalogue_det($table2, $tab, $method, $file_det,$bdd);
                                    if($valid2 == 'ok'){$valide = "ok";}
                                }
                                

                            }
                        }
                }
                    
                unset($query,$donnees, $binding, $verif_data,$verif_bind, $verif,$id_insert,$fichier1,$fichier2, $file_art, $file_det ,$ext, $ext2 ,$patch ,$nameDirec,$browsing  );

            }
            else {
                $valide = '';
            }
        }
        elseif ($group == 'upgrade'){


            $id_compt = isset($_POST['f4t']) ? htmlentities(addslashes($_POST['f4t'])) : '';
            $dom = isset($_POST['domaine']) ? htmlentities(addslashes($_POST['domaine'])) : '';
            $titre = isset($_POST['titre']) ? char(htmlentities(addslashes($_POST['titre']))) : '';
            $code = isset($_POST['code']) ? htmlentities(addslashes($_POST['code'])) : '';
            $autorise = 0;
            $directory = "files/files_upload_cat/";
            $content_types_list = mimeTypes();

// Check if DATA EXIST
            $verif_data = array(
                'champs' => "ID_CAT_FRS",
                'table' => catalogue,
                'where' => "ID_CMPT = :cmpt AND ID_DOM_A = :dom AND MODE = :mode",
                'tri' => "ORDER BY ID_CAT_FRS ASC"
            );
            $verif_bind = array(':cmpt' => $id_compt, ':dom' => $dom, ':mode' => $mode);
            $query->hydrate($verif_data);
            $query->select($verif_bind);
            $verif = $query->getVariable();

            if(count($verif) > 0) {
                // Hydrating and Update if value existe
                $donnees = array(
                    'modes' => "TITRE =:titre,AUTORISER =:autorise ,MODIFIER_LE=:creer",
                    'table' =>  catalogue,
                    'where' => "ID_DOM_A =:dom AND ID_CMPT =:cmpt AND MODE=:mode",
                );
                $binding = array(':dom' => $dom, ':cmpt' => $id_compt, ':titre' => (string)$titre,':autorise' => $autorise, ':creer' => $date, ':mode' => $mode);

                $query->hydrate($donnees);
                $query->update($binding);
                $valid = $query->getVariable();

                $browsing = array('files' => $_FILES["catalogue"],'nbre'=>count($_FILES["catalogue"]),  'doc' => $directory, 'mime' =>$content_types_list);
                $nameDirec = $manager->uploading($browsing);
                $id_insert = "";
                foreach ($verif as $value){$id_insert = $value[0];}
                if(!empty($nameDirec)){

                  if(!empty($id_insert) && !empty($valid)){

                      // GET if DATA EXIST
                      $verif_data2 = array(
                          'champs' => "ID_ART_CAT",
                          'table' => article_cataloguer,
                          'where' => "ID_CAT_FRS = :cat AND MODE = :mode",
                          'tri' => "ORDER BY ID_ART_CAT ASC"
                      );
                      $verif_bind2 = array(':cat' => $id_insert, ':mode' => $mode);
                      $query->hydrate($verif_data2);
                      $query->select($verif_bind2);
                      $verif2 = $query->getVariable();

                        $fichier1 = addslashes(htmlentities($_FILES["article"]['name'][0]));
                        $file_art = addslashes(htmlentities($_FILES["article"]['tmp_name'][0]));

                        $fichier2 = addslashes(htmlentities($_FILES["det_article"]['name'][0]));
                        $file_det = addslashes(htmlentities($_FILES["det_article"]['tmp_name'][0]));
                        //---------------------------------------------
                        $ext = get_file_ext($fichier1);      $ext2 = get_file_ext($fichier2);
                        $patch = '../../php/';
                        $method = "updating";
                      foreach ($verif2 as $item){
                          $tabUp[] = $item[0];
                      }
                        if(array_key_exists($ext, $content_types_list) && array_key_exists($ext2, $content_types_list)) {
                            $table1 = article_cataloguer; $table2 = details_art_cata;
                            $tab = import_catalogue_art($table1, $id_insert,$method, $patch, $file_art,$bdd);

                           $tab = $tabUp;

                            if(count($tab)>0){
                                $valid2 = import_catalogue_det($table2, $tab, $method, $file_det,$bdd);
                                if($valid2 == 'ok'){$valide = "ok";}
                            }


                        }
                    }
                }

                unset($query,$donnees, $binding, $verif_data,$verif_bind, $verif,$verif_data2,$verif_bind2, $verif2,$id_insert,$fichier1,$fichier2, $file_art, $file_det ,$ext, $ext2 ,$patch ,$nameDirec,$browsing  );

            }
            else {
                $valide = '';
            }
        }


    }
    elseif ($type == 'facture'){
        $agree = htmlentities(addslashes($_POST['f4t']));
        $id_bc = htmlentities(addslashes($_POST['clt']));
        $num_fact = htmlentities(addslashes($_POST['code']));
        $titre = htmlentities(addslashes($_POST['titre']));

        $directory = "files/files_facture/";
        $content_types_list = mimeTypes();

// Check if DATA ETAT is 1
        $verif_data = array(
            'champs' => "ID_DOC_F",
            'table' => doc_fac,
            'where' => "ID_AGRE = :agree AND ID_BC = :clause AND NUM_FAC =:fact AND MODE = :mode",
            'tri' => "ORDER BY ID_DOC_F ASC"
        );
        $verif_bind = array(':agree' => $agree, ':clause' => $id_bc, 'fact' => $num_fact, ':mode' => $mode);
        $query->hydrate($verif_data);
        $query->select($verif_bind);
        $verif = $query->getVariable();

        if(count($verif) == 0){
                    $content_types_list = mimeTypes();
                    $browsing = array('files' => $_FILES["facture"],'nbre'=>count($_FILES["facture"]),  'doc' => $directory, 'mime' =>$content_types_list);
                    $nameDirec = $manager->uploading($browsing);

                    if(!empty($nameDirec)){
                        // Hydrating and Update if value existe
                        $donnees = array(
                            'champs' => "ID_AGRE, ID_BC, NUM_FAC, LIBELLE, PIECE_JOINTE, MODE",
                            'table' => doc_fac,
                            'value' => ":agre, :bc, :num, :titre, :piece, :mode",
                        );
                        $binding = array(':agre' => $agree,':bc' => $id_bc , ':num' => $num_fact, ':titre' => $titre,':piece' => (string)$nameDirec,':mode' => $mode);

                        $query->hydrate($donnees);
                        $query->insert($binding);
                        $valide = $query->getVariable();
                        unset($query,$donnees, $binding, $verif_data,$verif_bind, $verif );

                    }
                }
                else {
                    $valide = '';
                }

    }

    $result = (!empty($valide)) ? array('result'=>'ok') : array('result'=>'none');
    print json_encode($result , JSON_NUMERIC_CHECK);
?>