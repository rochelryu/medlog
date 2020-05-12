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
   extract($_POST);
    $sujet = isset($_POST['idt4']) ? htmlentities(addslashes($_POST['idt4'])) : '';
    $type = isset($_POST['poster']) ? htmlentities(addslashes($_POST['poster'])) : '';
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    $verifData = "";
     $query = new Mysql_query($bdd);
        if($type == 'view'){
            // Mise a jour de la vue pour avoir cliquer dessus
            // Hydrating and Update value Setting Area
            $donnees = array(
                'modes' => "VUE = VUE + :vue",
                'table' =>  sujet_agrem,
                'where' => "ID_SUJ_A =:sujet AND MODE=:mode",
            );
            $binding = array(':vue' =>$mode,':sujet' =>$sujet,':mode' => $mode);
            $query->hydrate($donnees);
            $query->update($binding);
            $dataUpdate= $query->getVariable();

            if(!empty($dataUpdate)) {
// toute les informations du sujet lancé
                $get_dataS = array(
                    'champs' => "LIBELLE,CATEGORIE ,DETAILS,COMMENT ,VUE ,CREER_PAR , CREER_LE, MODIFIER_LE",
                    'table' => sujet_agrem,
                    'where' => "ID_SUJ_A = :sujet AND MODE = :mode",
                    'tri' => "ORDER BY ID_SUJ_A ASC"
                );
                $get_bindS = array(':sujet' => $sujet, ':mode' => $mode);

                $query->hydrate($get_dataS);
                $query->select($get_bindS);
                $dataSujet = $query->getVariable();
// toute les postes envoyer
                $get_dataP = array(
                    'champs' => "ID_POST_SUJ_A,PROFIL ,COMMENTAIRE ,CREER_PAR , CREER_LE",
                    'table' => post_sujet_a,
                    'where' => "ID_SUJ_A = :sujet",
                    'tri' => "ORDER BY ID_POST_SUJ_A DESC"
                );
                $get_bindP = array(':sujet' => $sujet);

                $query->hydrate($get_dataP);
                $query->select($get_bindP);
                $dataPost = $query->getVariable();
                if (count($dataPost) > 0 || count($dataSujet) > 0) {

                    foreach ($dataSujet as $value){
                    ?>
                    <h5><a href="#"><?php echo $value[0];?></a></h5>
                    <ul class="meta-post">
                        <li>Le : <span class="date"><?php echo empty($value[7]) ? $value[6] : $value[7];?></span></li>
                        <li>Par : <span class="author"><a href="#"><?php echo $value[5];?></a></span></li>
                        <li>Commentés : <span class="badge"><a href="#"><?php echo $value[3];?></a></span></li>
                        <li>Categorie : <span class="author"><a href="#"><?php echo $value[1];?></a></span>
                        </li>
                        <li>Vue : <?php echo $value[4];?></li>
                    </ul>
                    <p><?php echo $value[2];?></p>
                    <?php } ?>
|
                    <h3><?php echo count($dataPost);?> Commentaires</h3>
|
                    <ul class="pre-scrollable">
                        <?php
                    foreach ($dataPost as $item){
                        $image = ($item[1] == "Fournisseur") ? "Img-Comment2": "Img-Comment1";
                        ?>
                           <li>
                            <div class="Block-Comment">
                                <img src="../../style/images/blog/<?php echo $image;?>.png" alt="post footer" width="44" height="44">
                                <h4><?php echo $item[3];?></h4>
                                <span><?php echo $item[4];?> <a href="#">Poster</a></span>
                                <p><?php echo $item[2];?> </p>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
<?php
                }
                unset($donnees, $binding, $get_bindP, $get_dataP,$get_dataS,$get_bindS );

            }
        }
        elseif($type == 'Poster'){
        $mode = 1;
            $id_sujet = isset($_POST['sujet']) ? htmlentities(addslashes($_POST['sujet'])) : '';
            $profil = isset($_POST['profil']) ? htmlentities(addslashes($_POST['profil'])) : '';
            $four = isset($_POST['four']) ? htmlentities(addslashes($_POST['four'])) : '';
            $message = isset($_POST['message']) ?char(htmlentities(addslashes($_POST['message']))) : '';
// Mise a jour des commentaire pour avoir cliquer dessus
            // Hydrating and Update value Setting Area
            $donnees = array(
                'modes' => "COMMENT = COMMENT + :com",
                'table' =>  sujet_agrem,
                'where' => "ID_SUJ_A =:sujet AND MODE=:mode",
            );
            $binding = array(':com' =>$mode,':sujet' =>$id_sujet,':mode' => $mode);
            $query->hydrate($donnees);
            $query->update($binding);
            $dataUpdate = $query->getVariable();
            
            if(!empty($dataUpdate)){
                unset($donnees, $binding);
                // insert des commentaire pour avoir cliquer dessus
                // Hydrating and Update value Setting Area
                $donnees = array(
                    'champs' => "ID_SUJ_A ,PROFIL ,COMMENTAIRE ,CREER_PAR ,CREER_LE",
                    'table' => post_sujet_a,
                    'value' => ":sujet, :profil, :com, :creer, :le",
                );
                $binding = array(':sujet' =>$id_sujet, ':profil'=>$profil, ':com'=>(string)$message, ':creer'=>$four, ':le'=>$date);
                $query->hydrate($donnees);
                $query->insert($binding);
                $dataInsert = $query->getVariable();
                $last_id = $query->lastId();
                
                if (!empty($dataInsert) && $last_id>0){
                    print json_encode(array('resultat' => 'ok'), JSON_NUMERIC_CHECK);
                }
                elseif (empty($verifData)) {
                    print json_encode(array('resultat' => 'none'), JSON_NUMERIC_CHECK);
                }
            }
        }
?>
