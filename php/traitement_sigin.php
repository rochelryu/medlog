<?php
/**
 * Created by PhpStorm.
 * User: ZEN
 * Date: 26/04/2016
 * Time: 02:00
 */

header('content-type:text/json; charset=utf-8');

require_once('../functions/pdo_connect.php');
require_once('../functions/function.traitement.php');
require_once('../define/define.php');
require_once('../functions/encode_utf8.php');
require_once('../functions/extension.php');
require_once('../callback.php');

$propriete = array();
$checking = array();

//
$format = 'd/m/y, H:i:s';
$supplier = new Fourniss($bdd);
$getting = new Manager($bdd);
$valid = "";
$mode = 1;
$creer = date($format);
$emailCmpt = "";
$pass = "";
// Post structure
extract($_POST);

if(isset($_POST['code'])){

    $dom = htmlentities(addslashes($_POST['domaine']));
    $code = char(htmlentities(addslashes($_POST['code'])));
    $pass = sha1(htmlentities(addslashes($_POST['conf_pass'])));
    $emailCmpt = htmlentities(addslashes($_POST['email']));
    $dateins= htmlentities(addslashes($_POST['date']));

    // Hydrating and check if this Supplier is in Data Base

    $verif_data = array(
        'champs' => "ID_CMPT",
        'table' => demandeur,
        'where' => "ID_DOM_A = :dom AND EMAIL = :email AND MODE = :mode",
        'tri' => "ORDER BY ID_CMPT ASC"
    );
    $verif_bind = array(':dom' =>$dom,':email' =>$emailCmpt,':mode' => $mode);

    // ---------- End ------------------------

    // Hydrating and Insert value Setting Area
    $donnees = array(
        'champs' => "ID_DOM_A, CODE_CANDIDAT, PASS, EMAIL, DATE_INSC, CREER_LE, MODIFIER_LE, MODE",
        'table' => demandeur,
        'value' => ":dom, :code, :pass, :email, :dateins, :creer, :modif, :mode",
    );
    $binding = array(
        ':dom' =>$dom,':code' =>$code,':pass' =>$pass,':email' =>$emailCmpt,
        ':dateins' =>$dateins, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

    // ---------- End ------------------------

    $checking = array($verif_data, $verif_bind);
    $propriete['compte']= array($donnees, $binding);

    // Unset values
    unset($donnees , $binding , $verif_data, $verif_bind);
    // Fin

    /*
     * Call method to set sigin for Save Acompte and get Last Id insert
     */
    $supplier->checking_supplier($checking);
    $resul1 = $supplier->create_supplier($propriete);
    $id_ins = $supplier->getLastId();

// ******************* Domaine d exercie *******************

    $det_dom = char(htmlentities(addslashes($_POST['detail_dom'])));
    $nom_char = char(htmlentities(addslashes($_POST['nom_charger'])));
    $prenom_char = char(htmlentities(addslashes($_POST['prenom_charger'])));
    $raison = char(htmlentities(addslashes($_POST['raison'])));
    $post_char = char(htmlentities(addslashes($_POST['Poste_charger'])));
    $email_char = char(htmlentities(addslashes($_POST['email_charger'])));
    $attestation = "";
//Espace du telecharment de la piesse des pièces jointes

    if(isset($_FILES['fichier']) && is_array($_FILES)) {
        $Doc = "../Espace/Traitement/files/files_upload_attestation/";
        $content_types_list = mimeTypes();
        $browsing = array('files' => $_FILES['fichier'],'nbre'=>count($_FILES['fichier']),  'doc' => $Doc, 'mime' => $content_types_list);
        $attestation = $getting->uploading($browsing);

    }
    $signature = char(htmlentities(addslashes($_POST['signature'])));


    // Hydrating and Insert value Setting Area
    $donnees = array(
        'champs' => "ID_CMPT ,DETAILS_DOM ,RAISON_FRS ,NOM_CHARGER ,PRENOMS_CHARGER ,POSTE ,EMAIL ,ATTESTATION ,SIGNATURE,               
        CREER_LE, MODIFIER_LE ,MODE",
        'table' =>  detail_compte,
        'value' => ":comp, :det, :raison, :nom, :prenom, :poste, :email, :attest, :sign, :creer, :modif ,:mode",
    );
    $binding = array(':comp' =>$id_ins,':det' =>$det_dom,':raison' =>$raison,':nom' =>$nom_char, ':prenom' =>$prenom_char, ':poste' => $post_char,':email' => $email_char,':attest' => $attestation,
        ':sign' => $signature,':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

    // ---------- End ------------------------

    $propriete['detail_compte'][]= array($donnees, $binding);
   // $resul2 = $supplier->create_supplier_second($propriete);
    // Unset values
    unset($donnees);unset($binding);
    // Fin

        //************** Info Generale ************************

        /* $denom = char(htmlentities(addslashes($_POST['denom'])));
        $group = ((empty($_POST['group'])) ? NULL : char(htmlentities(addslashes($_POST['group']))));
        $filiale = ((empty($_POST['group'])) ? NULL : char(htmlentities(addslashes($_POST['filiale']))));
        $pays_siege = char(htmlentities(addslashes($_POST['pays_siege'])));
        $ville_siege = char(htmlentities(addslashes($_POST['ville_siege'])));
        $adress = char(htmlentities(addslashes($_POST['adress'])));
        $sit_geo = char(htmlentities(addslashes($_POST['sit_geo'])));
        $tel = htmlentities(addslashes($_POST['tel']));
        $fax = htmlentities(addslashes($_POST['fax']));
        $email_soci = htmlentities(addslashes($_POST['email_soci']));
        $site_soci = char(htmlentities(addslashes($_POST['site_soci'])));
        $capital = htmlentities(addslashes($_POST['capital']));
        $capito_ext = htmlentities(addslashes($_POST['capito_ext']));
        $forme = char(htmlentities(addslashes($_POST['forme'])));
        $crea_entr = htmlentities(addslashes($_POST['crea_entr']));
        $objet = char(htmlentities(addslashes($_POST['objet'])));
        $immatricu = char(htmlentities(addslashes($_POST['immatricu'])));
        $compte_contr = htmlentities(addslashes($_POST['compte_contr']));
        $regime_fisc = char(htmlentities(addslashes($_POST['regime_fisc'])));
        $imposition = char(htmlentities(addslashes($_POST['imposition'])));
        $etabli_bnk = char(htmlentities(addslashes($_POST['etabli_bnk'])));
        $pays_bnk = char(htmlentities(addslashes($_POST['pays_bnk'])));
        $ville_sieg = char(htmlentities(addslashes($_POST['ville_siege_bnk'])));
        $adress_bnk = char(htmlentities(addslashes($_POST['adress_bnk'])));
        $num_comp = htmlentities(addslashes($_POST['num_compte']));
        $rib = htmlentities(addslashes($_POST['rib']));
        $iban = htmlentities(addslashes($_POST['iban']));
        $swift = htmlentities(addslashes($_POST['swift']));


        // Hydrating and Insert value Setting Area
        $donnees = array(
            'champs' => "ID_CMPT ,DENOMINATION ,GROUPE ,FILIALES ,PAYS_SIEGE ,VILLE ,ADRESSE ,SITUATION_GEO ,TELEPHONE ,FAX ,EMAIL ,SITE_WEB ,CAPITAL_SOCIAL ,CAPITAUX_ETR ,FORME_JUR ,DATE_CREATION ,OBJET_SOCIAL ,IMMATRICULATION ,COMPTE_CONTRI ,REGIME_FISCAL ,CENTRE_IMPOSI ,ETABLISSEMENT_BANK ,PAYS_BANK ,VILLE_BANK ,ADRESSE_BANK ,COMPTE_BANK ,RIB ,IBAN ,SWIFT ,CREER_LE ,MODIFIER_LE ,MODE",
            'table' => info_demandeur,
            'value' => ":comp, :denom, :group, :filial, :paysS, :villeS, :adress, :sitGeo, :tel, :fax, :email, :siteW, :capitS, :capitE, :form, :crea, :objS, :imat, :contri, :regim, :impo, :etabl, :paysB, :villeB, :adressB, :comptB, :rib, :iban, :swift, :creer, :modif, :mode",
        );
        $binding = array(':comp' =>$id_ins, ':denom' =>$denom, ':group' =>$group, ':filial' =>$filiale, ':paysS' =>$pays_siege,
            ':villeS' =>$ville_siege, ':adress' =>$adress,':sitGeo' =>$sit_geo,':tel'=>$tel, ':fax'=>$fax, ':email'=>$email_soci, ':siteW'=>$site_soci ,':capitS' =>$capital, ':capitE' =>$capito_ext, ':form' =>$forme, ':crea' =>$crea_entr, ':objS' =>$objet, ':imat' =>$immatricu, ':contri' =>$compte_contr,
            ':regim' =>$regime_fisc, ':impo' =>$imposition, ':etabl' =>$etabli_bnk, ':paysB' =>$pays_bnk, ':villeB' =>$ville_sieg, ':adressB' =>$adress_bnk, ':comptB' =>$num_comp, ':rib' =>$rib, ':iban' =>$iban, ':swift' =>$swift, ':creer' =>$creer, ':modif' =>NULL, ':mode' =>$mode);

        // ---------- End ------------------------

        $propriete['info_demandeur'][] = array($donnees, $binding);
        //$resul3 = $supplier->create_supplier_second($propriete);
        // Unset values
        unset($donnees);unset($binding);
        // Fin

        //****************** Ressource Humaine********************

        $salarie = htmlentities(addslashes($_POST['nbr_salarie']));
        $cadre = htmlentities(addslashes($_POST['nbr_cadre']));
        $nbr_sal_cn = htmlentities(addslashes($_POST['nbr_salarie_cnps']));
        $nbr_sal_ci = htmlentities(addslashes($_POST['nbr_salarie_cdi']));
        $nbr_sal_cd = htmlentities(addslashes($_POST['nbr_salarie_cdd']));
        $nbr_sal_t = htmlentities(addslashes($_POST['nbr_salarie_tempo']));
        $per_sal_ci = htmlentities(addslashes($_POST['per_salarie_cdi']));
        $per_sal_cd = htmlentities(addslashes($_POST['per_salarie_cdd']));
        $per_sal_t = htmlentities(addslashes($_POST['per_salarie_tempo']));
        $moy_anc = htmlentities(addslashes($_POST['moy_ancien']));
        $moy_age = htmlentities(addslashes($_POST['moy_age']));
        $taux = htmlentities(addslashes($_POST['taux']));


        // Hydrating and Insert value Setting Area
        $donnees = array(
            'champs' => "ID_CMPT ,NBR_SALARIES ,NBR_CADRE ,NBR_SALARIES_CNPS ,NBR_SALARIES_CDI ,NBR_SALARIES_CDD ,NBR_TRAVAILLEUR_TEMPO ,PERCENT_SALARIES_CDI ,
            PERCENT_SALARIES_CDD ,PERCENT_TRAVAILLEUR_TEMPO ,ANCIENNETE_MOYENNE ,AGE_MOYEN ,TAUX_TURN_OVER ,CREER_LE ,MODIFIER_LE ,MODE",
            'table' => info_rh_four,
            'value' => ":comp, :nbSal, :nbCad, :nbSalCnps, :nbSalCdi, :nbSalCdd, :nbSalTem, :perSalCdi,
                        :perSalCdd, :perSaltem, :moyAnc, :moyAge, :taux, :creer, :modif, :mode",
        );
        $binding = array(':comp' =>$id_ins, ':nbSal' =>$salarie, ':nbCad' =>$cadre, ':nbSalCnps' =>$nbr_sal_cn, ':nbSalCdi' =>$nbr_sal_ci, ':nbSalCdd' =>$nbr_sal_cd, ':nbSalTem' =>$nbr_sal_t, ':perSalCdi' =>$per_sal_ci,
            ':perSalCdd' =>$per_sal_cd, ':perSaltem' =>$per_sal_t, ':moyAnc' =>$moy_anc, ':moyAge' =>$moy_age, ':taux' =>$taux, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

        // ---------- End ------------------------
        $propriete['info_rh_four'][] = array($donnees, $binding);
       // $resul4 = $supplier->create_supplier_second($propriete);
        // Unset values
        unset($donnees);unset($binding);
        // Fin

        // **************** Potions Commerciale ************************

        $activ_p = char(htmlentities(addslashes($_POST['activit_p'])));
        $activ_s = char(htmlentities(addslashes($_POST['activit_s'])));
        $marq = (empty($_POST['activit_p']) ? NULL : char(htmlentities(addslashes($_POST['marques']))));
        $nbr_ref = htmlentities(addslashes($_POST['nbr_ref']));
        $serv_aft = htmlentities(addslashes($_POST['serv_after_sell']));
        $dimens = char(htmlentities(addslashes($_POST['dimenssion'])));
        $ref_com = char(htmlentities(addslashes($_POST['ref_com'])));
        $etes_v = "";
        for($k=0; $k<count($_POST['etes_vous']); $k++){
                $etes_v .= char(htmlentities(addslashes($_POST['etes_vous'][$k]))).'; ';
        }
        $secteur = char(htmlentities(addslashes($_POST['secteur'])));
        $client = (empty($_POST['activit_p']) ? NULL : char(htmlentities(addslashes($_POST['client']))));
        $prod_s = char(htmlentities(addslashes($_POST['prod_serv'])));
        $ref_entr = char(htmlentities(addslashes($_POST['ref_entre'])));
        $type = char(htmlentities(addslashes($_POST['type'])));
        $lequel = char(htmlentities(addslashes($_POST['lequel'])));
        $orga_com = char(htmlentities(addslashes($_POST['orga_com'])));


        // Hydrating and Insert value Setting Area
        $donnees = array(
            'champs' => "ID_CMPT ,ACTIVITE_P ,ACTIVITE_S ,MARQUES ,NBR_REFERENCE ,SERVICE_AP ,DIMENTIONS ,REFERNCE_COM ,ETES_VS ,SECTEURS_ACTIVITE ,
            CLIENTS ,PRODUITS_SERVICE ,REFRENCE_ENTR ,TYPE_MARCHE ,LE_QUEL ,ORGANISATION_COM ,CREER_LE ,MODIFIER_LE ,MODE",
            'table' => info_pc_four,
            'value' => ":comp, :actiP, :activS, :marq, :nbRef, :servA, :dime, :refC, :eteV, :sect, :cli, :prod, :refE, :typM, :leQ, :orga, :creer, :modif, :mode",
        );
        $binding = array(':comp' =>$id_ins, ':actiP' =>$activ_p, ':activS' =>$activ_s, ':marq' =>$marq, ':nbRef' =>$nbr_ref, ':servA' =>$serv_aft, ':dime' =>$dimens, ':refC' =>$ref_com,
            ':eteV' =>$etes_v, ':sect' =>$secteur, ':cli' =>$client, ':prod' =>$prod_s, ':refE' =>$ref_entr, ':typM' =>$type, ':leQ' =>$lequel,
            ':orga' =>$orga_com, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

        // ---------- End ------------------------

        $propriete['info_pc_four'][]= array($donnees, $binding);
        //$resul5 = $supplier->create_supplier_second($propriete);
        // Unset values
        unset($donnees);unset($binding);
        // Fin

    //******************* CHIFFRE D AFFAIRE****************

        for($j=0; $j<count($_POST['N']); $j++){
            $an = htmlentities(addslashes($_POST['N'][$j]));
            $ca = htmlentities(addslashes($_POST['ca'][$j]));
            $resNet = htmlentities(addslashes($_POST['res_net'][$j]));
$l = $j+1;
            // Hydrating and Insert value Setting Area
            $donnees = array(
                'champs' => "ID_CMPT ,ANNEE ,CA ,RESULTATS_NET ,ORDRE, CREER_LE ,MODIFIER_LE ,MODE",
                'table' => info_ca_four,
                'value' => ":comp, :annee, :ca, :res, :ordre,:creer, :modif, :mode",
            );
            $binding = array(':comp'=>$id_ins, ':annee'=>$an, ':ca'=>$ca, ':res'=>$resNet, ':ordre' => $l,':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

            // ---------- End ------------------------

            $propriete['info_ca_four'][]= array($donnees, $binding);
           // $resul6 = $supplier->create_supplier_second($propriete);
            // Unset values
            unset($donnees);unset($binding);
            // Fin

        }
    //****************** CONTACT ********************

        for($i=0; $i<count($_POST['titre_cnt']); $i++){
            $titre = char(htmlentities(addslashes($_POST['titre_cnt'][$i])));
            $nom_dir = char(htmlentities(addslashes($_POST['nom_cnt'][$i])));
            $prenom_dir = char(htmlentities(addslashes($_POST['prenoms_cnt'][$i])));
            $tel_dir = htmlentities(addslashes($_POST['tel_cnt'][$i]));
            $email_dir = htmlentities(addslashes($_POST['email_cnt'][$i]));

            // Hydrating and Insert value Setting Area
            $donnees = array(
                'champs' => "ID_CMPT,TITRE ,NOM ,PRENOMS ,TELEPHONE ,EMAIL ,CREER_LE ,MODIFIER_LE ,MODE",
                'table' => info_contact_four,
                'value' => ":comp, :titre, :nom, :prenom, :tel, :email, :creer, :modif, :mode",
            );
            $binding = array(':comp' =>$id_ins, ':titre'=>$titre, ':nom'=>$nom_dir, ':prenom'=>$prenom_dir, ':tel'=>$tel_dir, ':email'=>$email_dir, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);

            // ---------- End ------------------------

            $propriete['info_contact_four'][]= array($donnees, $binding);
            //$resul7 = $supplier->create_supplier_second($propriete);
            // Unset values
            unset($donnees);unset($binding);
            // Fin
    }
            /*
             * Call method to set sigin for Save Acompte and get Last Id insert
             */

    //-------------------------------------------------------------------------

     $resul = $supplier->create_supplier_second($propriete);
    /*
     * Call test all value return by create_supplier method
     */

    if($resul1 == 'inserted'){
        $valid = 'inserted';
    }else{
        $valid = 'aborted';
    }

    //-----------------------------------------------------------------

    //Fin

    // Auto connexion
    if ($valid == 'inserted'){
        $tablo['table'] = demandeur;
        $tablo['login'] = $emailCmpt;
        $tablo['pass'] = $pass;
        
        session_start();
        if($supplier->connexion($tablo) == true){

            $tab = array('retruns' => $valid);
            print json_encode($tab , JSON_NUMERIC_CHECK);
        }

    }

}
elseif(isset($_POST['update'])){
    $valid = "";
    $zone = isset($_POST['zone']) ? htmlentities(addslashes($_POST['zone'])) : '';
    $newEdit = isset($_POST['newEdit']) ? htmlentities(addslashes($_POST['newEdit'])) : '2';
    $id_ins = isset($_POST['comp']) ? htmlentities(addslashes($_POST['comp'])) : '';

    if($zone == "compte"){
        // ************* Compte utilisateur *****************
        $dom = htmlentities(addslashes($_POST['domaine']));
        $pass = sha1(htmlentities(addslashes($_POST['conf_pass'])));
        $emailCmpt = htmlentities(addslashes($_POST['email']));

        // Hydrating and Insert value Setting Area
        $donnees = array(
            'modes' => "ID_DOM_A =:dom, PASS =:pass, EMAIL=:email, MODIFIER_LE =:creer",
            'table' => demandeur,
            'where' => "ID_CMPT = :comp AND MODE =:mode",
        );
        $binding = array(':dom' =>$dom,':comp' =>$id_ins,':pass' =>$pass,':email' =>$emailCmpt,':creer' =>$creer, ':mode' => $mode);

        // ---------- End ------------------------

        $propriete['compte']= array($donnees, $binding);
        $valid = $supplier->update_supplier($propriete);

        // Unset values
        unset($donnees , $binding , $dom,$code,$pass,$emailCmpt,$dateins);
        // Fin

    }
    elseif ($zone == "detCompte"){
        /*
         * Call method to set sigin for Save Acompte and get Last Id insert
         */

        // ******************* Domaine d exercie *******************

        $det_dom = char(htmlentities(addslashes($_POST['detail_dom'])));
        $nom_char = char(htmlentities(addslashes($_POST['nom_charger'])));
        $prenom_char = char(htmlentities(addslashes($_POST['prenom_charger'])));
        $raison = char(htmlentities(addslashes($_POST['raison'])));
        $post_char = char(htmlentities(addslashes($_POST['Poste_charger'])));
        $email_char = char(htmlentities(addslashes($_POST['email_charger'])));

        // Hydrating and Insert value Setting Area
        $donnees = array(
            'modes' => "DETAILS_DOM =:det,RAISON_FRS =:raison,NOM_CHARGER =:nom,PRENOMS_CHARGER =:prenom,POSTE =:poste,EMAIL =:email,MODIFIER_LE =:creer",
            'table' =>  detail_compte,
            'where' => "ID_CMPT =:comp AND MODE=:mode",
        );
        $binding = array(':comp' =>$id_ins,':det' =>$det_dom,':raison' =>$raison,':nom' =>$nom_char, ':prenom' =>$prenom_char, ':poste' => $post_char,':email' => $email_char,
            ':creer' =>$creer,':mode' => $mode);

        // ---------- End ------------------------

        $propriete['detail_compte'][]= array($donnees, $binding);
        $valid = $supplier->update_supplier_second($propriete);

        // Unset values
        unset($donnees,$binding,$det_dom,$nom_char,$prenom_char,$raison,$post_char,$email_char );
        // Fin
    }
    elseif($zone == "infos"){

        
        //************** Info Generale ************************
        
            $denom = char(htmlentities(addslashes($_POST['denom'])));
            $group = ((empty($_POST['group'])) ? NULL : char(htmlentities(addslashes($_POST['group']))));
            $filiale = ((empty($_POST['group'])) ? NULL : char(htmlentities(addslashes($_POST['filiale']))));
            $pays_siege = char(htmlentities(addslashes($_POST['pays_siege'])));
            $ville_siege = char(htmlentities(addslashes($_POST['ville_siege'])));
            $adress = char(htmlentities(addslashes($_POST['adress'])));
            $sit_geo = char(htmlentities(addslashes($_POST['sit_geo'])));
            $tel = htmlentities(addslashes($_POST['tel']));
            $fax = htmlentities(addslashes($_POST['fax']));
            $email_soci = htmlentities(addslashes($_POST['email_soci']));
            $site_soci = char(htmlentities(addslashes($_POST['site_soci'])));
            $capital = htmlentities(addslashes($_POST['capital']));
            $capito_ext = htmlentities(addslashes($_POST['capito_ext']));
            $forme = char(htmlentities(addslashes($_POST['forme'])));
            $crea_entr = htmlentities(addslashes($_POST['crea_entr']));
            $objet = char(htmlentities(addslashes($_POST['objet'])));
            $immatricu = char(htmlentities(addslashes($_POST['immatricu'])));
            $compte_contr = htmlentities(addslashes($_POST['compte_contr']));
            $regime_fisc = char(htmlentities(addslashes($_POST['regime_fisc'])));
            $imposition = char(htmlentities(addslashes($_POST['imposition'])));
            $etabli_bnk = char(htmlentities(addslashes($_POST['etabli_bnk'])));
            $pays_bnk = char(htmlentities(addslashes($_POST['pays_bnk'])));
            $ville_sieg = char(htmlentities(addslashes($_POST['ville_siege_bnk'])));
            $adress_bnk = char(htmlentities(addslashes($_POST['adress_bnk'])));
            $num_comp = htmlentities(addslashes($_POST['num_compte']));
            $rib = htmlentities(addslashes($_POST['rib']));
            $iban = htmlentities(addslashes($_POST['iban']));
            $swift = htmlentities(addslashes($_POST['swift']));

            // Hydrating and update value Setting Area
            if ($newEdit == '0') {
                $donnees = array(
                    'champs' => "ID_CMPT ,DENOMINATION ,GROUPE ,FILIALES ,PAYS_SIEGE ,VILLE ,ADRESSE ,SITUATION_GEO ,TELEPHONE ,FAX ,EMAIL ,SITE_WEB ,CAPITAL_SOCIAL ,CAPITAUX_ETR ,FORME_JUR ,DATE_CREATION ,OBJET_SOCIAL ,IMMATRICULATION ,COMPTE_CONTRI ,REGIME_FISCAL ,CENTRE_IMPOSI ,ETABLISSEMENT_BANK ,PAYS_BANK ,VILLE_BANK ,ADRESSE_BANK ,COMPTE_BANK ,RIB ,IBAN ,SWIFT ,CREER_LE ,MODIFIER_LE ,MODE",
                    'table' => info_demandeur,
                    'value' => ":comp, :denom, :group, :filial, :paysS, :villeS, :adress, :sitGeo, :tel, :fax, :email, :siteW, :capitS, :capitE, :form, :crea, :objS, :imat, :contri, :regim, :impo, :etabl, :paysB, :villeB, :adressB, :comptB, :rib, :iban, :swift, :creer, :modif, :mode",
                );
                $binding = array(':comp' =>$id_ins, ':denom' =>$denom, ':group' =>$group, ':filial' =>$filiale, ':paysS' =>$pays_siege,
                    ':villeS' =>$ville_siege, ':adress' =>$adress,':sitGeo' =>$sit_geo,':tel'=>$tel, ':fax'=>$fax, ':email'=>$email_soci, ':siteW'=>$site_soci ,':capitS' =>$capital, ':capitE' =>$capito_ext, ':form' =>$forme, ':crea' =>$crea_entr, ':objS' =>$objet, ':imat' =>$immatricu, ':contri' =>$compte_contr,
                    ':regim' =>$regime_fisc, ':impo' =>$imposition, ':etabl' =>$etabli_bnk, ':paysB' =>$pays_bnk, ':villeB' =>$ville_sieg, ':adressB' =>$adress_bnk, ':comptB' =>$num_comp, ':rib' =>$rib, ':iban' =>$iban, ':swift' =>$swift, ':creer' =>$creer, ':modif' =>NULL, ':mode' =>$mode);
            }
            else {
                $donnees = array(
                    'modes' => "DENOMINATION =:denom, GROUPE =:group ,FILIALES =:filial, PAYS_SIEGE =:paysS, VILLE =:villeS
                                ,ADRESSE =:adress, SITUATION_GEO =:sitGeo, TELEPHONE =:tel, FAX =:fax, EMAIL =:email, SITE_WEB =:siteW,
                                CAPITAL_SOCIAL =:capitS, CAPITAUX_ETR =:capitE, FORME_JUR =:form, DATE_CREATION =:crea, OBJET_SOCIAL =:objS,
                                IMMATRICULATION =:imat, COMPTE_CONTRI =:contri, REGIME_FISCAL =:regim, CENTRE_IMPOSI =:impo, ETABLISSEMENT_BANK =:etabl,
                                PAYS_BANK =:paysB, VILLE_BANK =:villeB, ADRESSE_BANK =:adressB, COMPTE_BANK =:comptB, RIB =:rib, IBAN =:iban,
                                SWIFT =:swift, MODIFIER_LE =:creer",
                    'table' => info_demandeur,
                    'where' => "ID_CMPT = :comp AND MODE = :mode",
                );

                $binding = array(':comp' =>$id_ins, ':denom' =>$denom, ':group' =>$group, ':filial' =>$filiale, ':paysS' =>$pays_siege,
                ':villeS' =>$ville_siege, ':adress' =>$adress,':sitGeo' =>$sit_geo,':tel'=>$tel, ':fax'=>$fax, ':email'=>$email_soci, ':siteW'=>$site_soci ,':capitS' =>$capital, ':capitE' =>$capito_ext, ':form' =>$forme, ':crea' =>$crea_entr, ':objS' =>$objet, ':imat' =>$immatricu, ':contri' =>$compte_contr,
                ':regim' =>$regime_fisc, ':impo' =>$imposition, ':etabl' =>$etabli_bnk, ':paysB' =>$pays_bnk, ':villeB' =>$ville_sieg, ':adressB' =>$adress_bnk, ':comptB' =>$num_comp, ':rib' =>$rib, ':iban' =>$iban, ':swift' =>$swift, ':creer' =>$creer, ':mode' =>$mode);
            }
        

            // ---------- End ------------------------

            $propriete['info_demandeur'][] = array($donnees, $binding);

            $valid = ($newEdit == '0') ? $supplier->create_supplier_second_alter($propriete) : $supplier->update_supplier_second($propriete);
            // Unset values
            unset($donnees,$binding,$propriete,$denom, $group, $filiale, $pays_siege, $ville_siege, $adress, $sit_geo,$tel ,$fax ,$email_soci ,$site_soci,$capital,$capito_ext,$forme,$crea_entr,$objet,$immatricu,$compte_contr ,$regime_fisc,$imposition,$etabli_bnk,$pays_bnk,$ville_sieg,$adress_bnk,$num_comp,$rib,$iban,$swift);        

    }
    elseif ($zone == "ress"){
        //****************** Ressource Humaine********************

        $salarie = htmlentities(addslashes($_POST['nbr_salarie']));
        $cadre = htmlentities(addslashes($_POST['nbr_cadre']));
        $nbr_sal_cn = htmlentities(addslashes($_POST['nbr_salarie_cnps']));
        $nbr_sal_ci = htmlentities(addslashes($_POST['nbr_salarie_cdi']));
        $nbr_sal_cd = htmlentities(addslashes($_POST['nbr_salarie_cdd']));
        $nbr_sal_t = htmlentities(addslashes($_POST['nbr_salarie_tempo']));
        $per_sal_ci = htmlentities(addslashes($_POST['per_salarie_cdi']));
        $per_sal_cd = htmlentities(addslashes($_POST['per_salarie_cdd']));
        $per_sal_t = htmlentities(addslashes($_POST['per_salarie_tempo']));
        $moy_anc = htmlentities(addslashes($_POST['moy_ancien']));
        $moy_age = htmlentities(addslashes($_POST['moy_age']));
        $taux = htmlentities(addslashes($_POST['taux']));


        // Hydrating and Insert value Setting Area

        if ($newEdit == '0') {
            $donnees = array(
                'champs' => "ID_CMPT ,NBR_SALARIES ,NBR_CADRE ,NBR_SALARIES_CNPS ,NBR_SALARIES_CDI ,NBR_SALARIES_CDD ,NBR_TRAVAILLEUR_TEMPO ,PERCENT_SALARIES_CDI ,
                PERCENT_SALARIES_CDD ,PERCENT_TRAVAILLEUR_TEMPO ,ANCIENNETE_MOYENNE ,AGE_MOYEN ,TAUX_TURN_OVER ,CREER_LE ,MODIFIER_LE ,MODE",
                'table' => info_rh_four,
                'value' => ":comp, :nbSal, :nbCad, :nbSalCnps, :nbSalCdi, :nbSalCdd, :nbSalTem, :perSalCdi,
                            :perSalCdd, :perSaltem, :moyAnc, :moyAge, :taux, :creer, :modif, :mode",
            );
            $binding = array(':comp' =>$id_ins, ':nbSal' =>$salarie, ':nbCad' =>$cadre, ':nbSalCnps' =>$nbr_sal_cn, ':nbSalCdi' =>$nbr_sal_ci, ':nbSalCdd' =>$nbr_sal_cd, ':nbSalTem' =>$nbr_sal_t, ':perSalCdi' =>$per_sal_ci,
                ':perSalCdd' =>$per_sal_cd, ':perSaltem' =>$per_sal_t, ':moyAnc' =>$moy_anc, ':moyAge' =>$moy_age, ':taux' =>$taux, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);
        }
        else {
            $donnees = array(
                'modes' => "NBR_SALARIES =:nbSal, NBR_CADRE =:nbCad,NBR_SALARIES_CNPS =:nbSalCnps,NBR_SALARIES_CDI =:nbSalCdi,NBR_SALARIES_CDD =:nbSalCdd
                            ,NBR_TRAVAILLEUR_TEMPO =:nbSalTem,PERCENT_SALARIES_CDI =:perSalCdi, PERCENT_SALARIES_CDD =:perSalCdd,PERCENT_TRAVAILLEUR_TEMPO =:perSaltem,
                            ANCIENNETE_MOYENNE =:moyAnc,AGE_MOYEN =:moyAge,TAUX_TURN_OVER =:taux, MODIFIER_LE =:creer",
                'table' => info_rh_four,
                'where' => "ID_CMPT =:comp AND MODE =:mode",
            );
            $binding = array(':comp' =>$id_ins, ':nbSal' =>$salarie, ':nbCad' =>$cadre, ':nbSalCnps' =>$nbr_sal_cn, ':nbSalCdi' =>$nbr_sal_ci, ':nbSalCdd' =>$nbr_sal_cd, ':nbSalTem' =>$nbr_sal_t, ':perSalCdi' =>$per_sal_ci,
                ':perSalCdd' =>$per_sal_cd, ':perSaltem' =>$per_sal_t, ':moyAnc' =>$moy_anc, ':moyAge' =>$moy_age, ':taux' =>$taux, ':creer' =>$creer, ':mode' => $mode);
        }


        // ---------- End ------------------------
        $propriete['info_rh_four'][] = array($donnees, $binding);
        $valid = ($newEdit == '0') ? $supplier->create_supplier_second_alter($propriete) : $supplier->update_supplier_second($propriete);
        // Unset values
        unset($donnees,$binding,$salarie,$cadre,$nbr_sal_cn,$nbr_sal_ci,$nbr_sal_cd,$nbr_sal_t,$per_sal_ci,$per_sal_cd,$per_sal_t,$moy_anc,$moy_age,$taux);
        // Fin
    }
    elseif ($zone == "posCom"){
        // **************** Potions Commerciale ************************

        $activ_p = char(htmlentities(addslashes($_POST['activit_p'])));
        $activ_s = char(htmlentities(addslashes($_POST['activit_s'])));
        $marq = (empty($_POST['activit_p']) ? NULL : char(htmlentities(addslashes($_POST['marques']))));
        $nbr_ref = htmlentities(addslashes($_POST['nbr_ref']));
        $serv_aft = htmlentities(addslashes($_POST['serv_after_sell']));
        $dimens = char(htmlentities(addslashes($_POST['dimenssion'])));
        $ref_com = char(htmlentities(addslashes($_POST['ref_com'])));
        $etes_v = "";
        for($k=0; $k<count($_POST['etes_vous']); $k++){
            $etes_v .= char(htmlentities(addslashes($_POST['etes_vous'][$k]))).'; ';
        }
        $secteur = char(htmlentities(addslashes($_POST['secteur'])));
        $client = (empty($_POST['activit_p']) ? NULL : char(htmlentities(addslashes($_POST['client']))));
        $prod_s = char(htmlentities(addslashes($_POST['prod_serv'])));
        $ref_entr = char(htmlentities(addslashes($_POST['ref_entre'])));
        $type = char(htmlentities(addslashes($_POST['type'])));
        $lequel = char(htmlentities(addslashes($_POST['lequel'])));
        $orga_com = char(htmlentities(addslashes($_POST['orga_com'])));


        // Hydrating and Insert value Setting Area

        if ($newEdit == '0') {
            $donnees = array(
                'champs' => "ID_CMPT ,ACTIVITE_P ,ACTIVITE_S ,MARQUES ,NBR_REFERENCE ,SERVICE_AP ,DIMENTIONS ,REFERNCE_COM ,ETES_VS ,SECTEURS_ACTIVITE ,
                CLIENTS ,PRODUITS_SERVICE ,REFRENCE_ENTR ,TYPE_MARCHE ,LE_QUEL ,ORGANISATION_COM ,CREER_LE ,MODIFIER_LE ,MODE",
                'table' => info_pc_four,
                'value' => ":comp, :actiP, :activS, :marq, :nbRef, :servA, :dime, :refC, :eteV, :sect, :cli, :prod, :refE, :typM, :leQ, :orga, :creer, :modif, :mode",
            );
            $binding = array(':comp' =>$id_ins, ':actiP' =>$activ_p, ':activS' =>$activ_s, ':marq' =>$marq, ':nbRef' =>$nbr_ref, ':servA' =>$serv_aft, ':dime' =>$dimens, ':refC' =>$ref_com,
                ':eteV' =>$etes_v, ':sect' =>$secteur, ':cli' =>$client, ':prod' =>$prod_s, ':refE' =>$ref_entr, ':typM' =>$type, ':leQ' =>$lequel,
                ':orga' =>$orga_com, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);
        }
        else {
            $donnees = array(
                'modes' => "ACTIVITE_P =:actiP,ACTIVITE_S =:activS,MARQUES =:marq,NBR_REFERENCE =:nbRef,SERVICE_AP =:servA,DIMENTIONS =:dime,REFERNCE_COM =:refC,
                ETES_VS =:eteV,SECTEURS_ACTIVITE =:sect, CLIENTS =:cli,PRODUITS_SERVICE =:prod,REFRENCE_ENTR =:refE,TYPE_MARCHE =:typM,LE_QUEL =:leQ,ORGANISATION_COM =:orga ,MODIFIER_LE =:creer",
                'table' => info_pc_four,
                'where' => "ID_CMPT =:comp AND MODE =:mode",
            );
            $binding = array(':comp' =>$id_ins, ':actiP' =>$activ_p, ':activS' =>$activ_s, ':marq' =>$marq, ':nbRef' =>$nbr_ref, ':servA' =>$serv_aft, ':dime' =>$dimens, ':refC' =>$ref_com,
                ':eteV' =>$etes_v, ':sect' =>$secteur, ':cli' =>$client, ':prod' =>$prod_s, ':refE' =>$ref_entr, ':typM' =>$type, ':leQ' =>$lequel,
                ':orga' =>$orga_com, ':creer' =>$creer,':mode' => $mode);
        }


        // ---------- End ------------------------

        $propriete['info_pc_four'][]= array($donnees, $binding);
        $valid = ($newEdit == '0') ? $supplier->create_supplier_second_alter($propriete) : $supplier->update_supplier_second($propriete);
        // Unset values
        unset($donnees,$binding,$activ_p ,$activ_s,$marq,$nbr_ref,$serv_aft,$dimens,$ref_com ,$etes_v ,$secteur,$client,$prod_s,$ref_entr,$type,$lequel,$orga_com);
        // Fin
    }
    elseif ($zone == "ca"){
        //******************* CHIFFRE D AFFAIRE****************

        for($j=0; $j<count($_POST['N']); $j++){
            $an = htmlentities(addslashes($_POST['N'][$j]));
            $ca = htmlentities(addslashes($_POST['ca'][$j]));
            $resNet = htmlentities(addslashes($_POST['res_net'][$j]));
            $l = $j+1;
            // Hydrating and Insert value Setting Area

            if ($newEdit == '0') {
                $donnees = array(
                    'champs' => "ID_CMPT ,ANNEE ,CA ,RESULTATS_NET ,ORDRE, CREER_LE ,MODIFIER_LE ,MODE",
                    'table' => info_ca_four,
                    'value' => ":comp, :annee, :ca, :res, :ordre,:creer, :modif, :mode",
                );
                $binding = array(':comp'=>$id_ins, ':annee'=>$an, ':ca'=>$ca, ':res'=>$resNet, ':ordre' => $l,':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);
            }
            else {
                $donnees = array(
                    'modes' => "ANNEE =:annee,CA =:ca,RESULTATS_NET =:res,MODIFIER_LE =:creer",
                    'table' => info_ca_four,
                    'where' => "ID_CMPT =:comp AND ORDRE = :ordre AND MODE =:mode",
                );
                $binding = array(':comp'=>$id_ins, ':annee'=>$an, ':ca'=>$ca, ':res'=>$resNet, ':ordre' => $l,':creer' =>$creer, ':mode' => $mode);
            }


            // ---------- End ------------------------

            $propriete['info_ca_four'][] = array($donnees, $binding);
            $valid = ($newEdit == '0') ? $supplier->create_supplier_second_alter($propriete) : $supplier->update_supplier_second($propriete);
            // Unset values
            unset($donnees,$binding, $an, $ca, $resNet, $propriete);
            // Fin

        }
    }
    elseif ($zone == "cont"){
        //****************** CONTACT ********************

        for($i=0; $i<count($_POST['titre_cnt']); $i++){
            $titre = char(htmlentities(addslashes($_POST['titre_cnt'][$i])));
            $nom_dir = char(htmlentities(addslashes($_POST['nom_cnt'][$i])));
            $prenom_dir = char(htmlentities(addslashes($_POST['prenoms_cnt'][$i])));
            $tel_dir = htmlentities(addslashes($_POST['tel_cnt'][$i]));
            $email_dir = htmlentities(addslashes($_POST['email_cnt'][$i]));

            // Hydrating and Insert value Setting Area

            if ($newEdit == '0') {
                $donnees = array(
                    'champs' => "ID_CMPT,TITRE ,NOM ,PRENOMS ,TELEPHONE ,EMAIL ,CREER_LE ,MODIFIER_LE ,MODE",
                    'table' => info_contact_four,
                    'value' => ":comp, :titre, :nom, :prenom, :tel, :email, :creer, :modif, :mode",
                );
                $binding = array(':comp' =>$id_ins, ':titre'=>$titre, ':nom'=>$nom_dir, ':prenom'=>$prenom_dir, ':tel'=>$tel_dir, ':email'=>$email_dir, ':creer' =>$creer, ':modif' => NULL, ':mode' => $mode);
            }
            else {
                $donnees = array(
                    'modes' => "TITRE =:titre,NOM =:nom,PRENOMS =:prenom,TELEPHONE =:tel,EMAIL =:email,MODIFIER_LE =:creer",
                    'table' => info_contact_four,
                    'where' => "ID_CMPT =:comp AND TITRE =:titres AND MODE =:mode",
                );
                $binding = array(':comp' =>$id_ins, ':titre'=>$titre, ':nom'=>$nom_dir, ':prenom'=>$prenom_dir, ':titres' => $titre,':tel'=>$tel_dir, ':email'=>$email_dir, ':creer' =>$creer, ':mode' => $mode);
            }

            // ---------- End ------------------------

            $propriete['info_contact_four'][]= array($donnees, $binding);
            $valid = ($newEdit == '0') ? $supplier->create_supplier_second_alter($propriete) : $supplier->update_supplier_second($propriete);
            // Unset values
            unset($donnees,$binding,$titre, $nom_dir, $prenom_dir, $tel_dir, $email_dir, $propriete);
            // Fin
        }
    }
    elseif ($zone == "files"){

        // Hydrating and check if this Supplier files if is in Data Base

        $verif_data = array(
            'champs' => "ATTESTATION",
            'table' => detail_compte,
            'where' => "ID_CMPT = :comp AND MODE = :mode",
            'tri' => "ORDER BY 	ID_DET_FRS ASC"
        );
        $verif_bind = array(':comp' =>$id_ins,':mode' => $mode);
        $query = new Mysql_query($bdd);
        $query->hydrate($verif_data);
        $query->select($verif_bind);
        $getFiles = $query->getVariable();
        $after_attestation = "";
                if(!empty($getFiles)){
                    foreach ($getFiles as $item){
                        $after_attestation = $item[0];
                    }
                }
        $dossier_traite = "../../SMART-MANAGER/Apps/HA-PRO/Acceuil/Interface/files/files_upload_attestation";
        $ancien_extension = get_file_ext($after_attestation);

        if(suppressionFile($dossier_traite , $after_attestation,$ancien_extension)){
            // ---------- End ------------------------

        $attestation = "";
//Espace du telecharment de la piesse des pièces jointes

        if (isset($_FILES['fichier']) && is_array($_FILES)) {
            $content_types_list = mimeTypes();
            $browsing = array('files' => $_FILES['fichier'], 'nbre' => count($_FILES['fichier']), 'doc' => $Doc, 'mime' => $content_types_list);
            $attestation = $getting->uploading($browsing);

        }

        // Hydrating and Insert value Setting Area
        $donnees = array(
            'modes' => "ATTESTATION =:attest, MODIFIER_LE =:creer",
            'table' => detail_compte,
            'where' => "ID_CMPT =:comp AND MODE =:mode",
        );
        $binding = array(':comp' => $id_ins, ':attest' =>(string) $attestation,':creer' => $creer,':mode' => $mode);

        // ---------- End ------------------------

        $propriete['detail_compte'][] = array($donnees, $binding);
        $valid = $supplier->update_supplier_second($propriete);
        // Unset values
        unset($donnees, $binding, $attestation,$creer,$browsing,$content_types_list,$ancien_extension,$after_attestation,$dossier_traite,$getFiles,$query,$verif_bind,$verif_data);
    }
    }

    $tab = array('retruns' => $valid);
    print json_encode($tab , JSON_NUMERIC_CHECK);

    unset($tab, $zone, $id_ins, $valid, $propriete, $checking);
}

?>