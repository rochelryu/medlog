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
    $agr = isset($_POST['idt4']) ? htmlentities(addslashes($_POST['idt4'])) : '';
    $user = isset($_POST['f4t']) ? htmlentities(addslashes($_POST['f4t'])) : '';
    $type = isset($_POST['type']) ? htmlentities(addslashes($_POST['type'])) : '';
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    $verifData = "";

        if($type == 'agrement'){
            $sth = $bdd->prepare("SELECT LIBELLE FROM ".agrement." WHERE ID_AGR = :agr ");
            $sth->bindParam(':agr', $agr, PDO::PARAM_INT);
            $sth->execute();
            $fetchAgr = $sth->fetchAll(PDO::FETCH_BOTH);
            $NameAgrem = "";
            foreach ($fetchAgr as $donnes){
                $NameAgrem = $donnes[0];
            }

        $req = $bdd->prepare("SELECT MOYENNE, CREER_PAR, COMMENTAIRE FROM ".nts_admin." WHERE ID_AGR = :agr AND ID_CMPT =:comp");
        $req->bindParam(':agr', $agr, PDO::PARAM_INT);
        $req->bindParam(':comp', $user, PDO::PARAM_INT);
        $req->execute();

            $numRow = $req->rowCount();

            if($numRow>0){
                $data = $req->fetchAll(PDO::FETCH_BOTH);
                $moy = 0;
                $acht = "";
                $coment = "";
                    foreach ($data as $value){
                        $moy = $value[0];
                        $acht = $value[1];
                        $coment = $value[2];
                    }
                ?>
                <div class="Pricing-block">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <i class="icon icon-Starship"></i>
                            <h3>Résultat de l'évaluation : Agrément : <?php echo $NameAgrem;?></h3>
                        </div>
                        <div class="pricing-price-midd">
                            <div class="pricing-price">
                                <span class="unit">Note =&nbsp;&nbsp;</span><?php echo $moy;?>
                            </div>
                            <p>Sur 20</p>
                        </div>
                        <div class="pricing-bottom">
                            <span class="label label-danger h6">Commentaire de l'évaluateur : <?php echo $acht;?></span>
                            <div class="divcod15"></div>
                            <p><?php echo $coment;?></p>
                            <div class="divcod15"></div>
                            <span class="badge"> Pour tous types de réclamations</span>
                            <div class="divcod10"></div>
                            <ul>
                                <li><b>Option 1</b> : Poster ou suivre les sujets du Forum Agrement</li>
                                <li><b>Option 2 </b>: Contacter L'acheteur en charge</li>
                            </ul>
                            <a class="btn black" href="#" onclick="javascript:location.reload();" title="Rafraichir">Actualiser</a>
                        </div>
                    </div>
                </div>
    <?php        }
            else{?>
                <div class="Pricing-block">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <i class="icon icon-Starship"></i>
                            <h3>Résultat de l'évaluation Agrément : <?php echo $NameAgrem;?></h3>
                        </div>
                        <div class="pricing-price-midd">
                            <div class="pricing-price">
                                <span class="unit">Note =&nbsp;&nbsp;</span>Aucune
                            </div>
                            <p>Sur 20</p>
                        </div>
                        <div class="pricing-bottom">
                            <span class="label label-danger h6">Aucun Commentaire</span>
                            <div class="divcod15"></div>
                            <p>Aucune évaluation n'a encore été éffectué pour cet Agrement.</p>
                            <ul>
                                <li><b>Option 1 </b>: Patienté</li>
                                <li><b>Option 2 </b>: Contacter l'acheteur en charge</li>
                            </ul>
                            <a class="btn black" href="#" onclick="javascript:location.reload();" title="Rafraichir">Actualiser</a>
                        </div>
                    </div>
                </div>
           <?php }
        }
        elseif($type == 'offre'){

        $table_eval_tech = "";
        $table_eval_fin = "";
        $appel = 0;
        $ref = "";
        $libelle = "";

        $query = $bdd->prepare("SELECT ID_APPEL, REF, LIBELLE, ID_TYPE_O FROM " . offre . "
                                  WHERE ID_APPEL = :appel
                                  AND MODE = :mode  
                                  ORDER BY ID_APPEL");
        $query->bindParam(':appel', $agr, PDO::PARAM_INT);
        $query->bindParam(':mode', $mode, PDO::PARAM_INT);
        $query->execute();
        $fetching = $query->fetchAll(PDO::FETCH_BOTH);
        $rowCount = $query->rowCount();

        foreach ($fetching as $donnes) {
            $appel = $donnes[0];
            if ($donnes[3] == 1) {
                $table_eval_tech = notation_tech_std;
                $table_eval_fin = notation_fin_std;
            } elseif ($donnes[3] == 2) {
                $table_eval_tech = notation_tech_pi;
                $table_eval_fin = notation_fin_pi;
            } elseif ($donnes[3] == 3) {
                $table_eval_tech = notation_tech_imp;
                $table_eval_fin = notation_fin_imp;
            } elseif ($donnes[3] == 4) {
                $table_eval_tech = notation_tech_prj;
                $table_eval_fin = notation_fin_prj;
            } elseif ($donnes[3] == 5) {
                $table_eval_tech = notation_tech_btp;
                $table_eval_fin = notation_fin_btp;
            } elseif ($donnes[3] == 6) {
                $table_eval_tech = notation_tech_sg;
                $table_eval_fin = notation_fin_sg;
            }
            $ref = $donnes[1];
            $appel = $donnes[0];
            $libelle = $donnes[2];
        }

        // Zone de Chargement des notations Techniques
        $req = $bdd->prepare("SELECT PONDERATION, POINT, POINT_POND, NOTE_PRES, NOTE_COMITE,NOTE_PAR FROM " . $table_eval_tech . " WHERE ID_APPEL = :appel AND ID_AGRE = :agree ");
        $req->bindParam(':appel', $appel, PDO::PARAM_INT);
        $req->bindParam(':agree', $user, PDO::PARAM_STR);
        $req->execute();
        $numRow = $req->rowCount();

        // Zone de Chargement des notations Financières
        $sth = $bdd->prepare("SELECT PONDERATION, POINT, POINT_POND, NOTE_ACHT, NOTE_COMITE,NOTE_PAR FROM " . $table_eval_fin . " WHERE ID_APPEL = :appel AND ID_AGRE = :agree ");
        $sth->bindParam(':appel', $appel, PDO::PARAM_INT);
        $sth->bindParam(':agree', $user, PDO::PARAM_STR);
        $sth->execute();
        $numRow2 = $sth->rowCount();

        if($numRow>0 && $numRow2>0){

            $data_tech = $req->fetchAll(PDO::FETCH_BOTH);
            $data_fin = $sth->fetchAll(PDO::FETCH_BOTH);

            $pond_tech = 0;     $pond_fin = 0;
            $point_tech = 0;    $point_fin = 0;
            $point_pond_tech = 0;   $point_pond_fin = 0;
            $coment_pres_tech = "";      $coment_acht_tech = "";
            $coment_com_tech = "";      $coment_com_fin = "";
            $noter_par_pres = "";       $noter_par_ach = "";

            $t_pond = 0;
            $t_cumul = 0;
       // fecth data tech
            foreach ($data_tech as $value) {
                $pond_tech = $value[0];
                $point_tech = $value[1];
                $point_pond_tech = $value[2];
                $coment_pres_tech = $value[3];
                $coment_com_tech = $value[4];
                $noter_par_pres = $value[5];
            }

      // fetch data fin
            foreach ($data_fin as $item){
                $pond_tech = $item[0];
                $point_tech = $item[1];
                $point_pond_tech = $item[2];
                $coment_pres_tech = $item[3];
                $coment_com_fin = $item[4];
                $noter_par_pres = $item[5];
            }

                if($pond_fin == $pond_tech){
                    $t_pond = $pond_fin;
                    $t_cumul = round(($point_pond_tech + $point_pond_fin)/2 ,2);
                }
                elseif($pond_fin != $pond_tech){
                    $t_pond = $pond_fin + $pond_tech;
                    $t_cumul = ($point_pond_tech + $point_pond_fin);

                }
            ?>
            <div class="Pricing-block">
                <div class="pricing-item">
                    <div class="pricing-header">
                        <i class="icon icon-Starship"></i>
                        <h3>Résultat de l'évaluation Appel d'Offre : <?php echo $libelle;?></h3>
                        <h6>Reférent : <?php echo $ref;?></h6>
                    </div>
                    <div class="pricing-price-midd">
                        <div class="pricing-price">
                            <span class="unit">Cahier de charge = </span><?php echo $point_pond_tech;?><br>
                            <span class="unit">Grille de cotation = </span><?php echo $point_pond_fin;?>
                        </div>
                        <p>Obtenu <?php echo $point_tech;?> | Pondéré sur <?php echo $pond_tech;?></p>
                    </div>
                    <div class="pricing-bottom">
                        <span class="label label-danger h6">Commentaire</span>
                        <div class="divcod10"></div>
                        <span class="label label-success">Par le comité d'évaluation</span>
                        <p>Sur le Cahier de Charge : <?php echo $coment_com_tech;?></p>
                        <p>Sur la Grille de Cotation : <?php echo $coment_com_fin;?></p>
                        <div class="divcod10"></div>
                        <span class="label label-success">Par le Prescripteur / Acheteur</span>
                        <p>Sur le Cahier de Charge : <?php echo $coment_pres_tech;?></p>
                        <p>Sur la Grille de Cotation : <?php echo $coment_acht_tech;?></p>
                        <div class="divcod15"></div>
                        <span class="badge"> Détails des evaluations</span>
                        <div class="divcod10"></div>
                        <ul>
                            <li><b>Cahier de Charge</b> : <span class="badge"> <?php echo $point_pond_tech;?> / <?php echo $pond_tech;?></span></li>
                            <li><b>Grille de Cotation</b>: <span class="badge"> <?php echo $point_pond_fin;?> / <?php echo $pond_fin;?></span></li>
                            <li><b>Cumul</b>: <span class="badge alert-success"> <?php echo $t_cumul;?> / <?php echo $t_pond;?></span></li>
                        </ul>
                        <a class="btn black" href="#" onclick="javascript:location.reload();" title="Rafraichir">Actualiser</a>
                    </div>
                </div>
            </div>
        <?php        }
        else{?>
            <div class="Pricing-block">
                <div class="pricing-item">
                    <div class="pricing-header">
                        <i class="icon icon-Starship"></i>
                        <h3>Résultat de l'évaluation Appel d'Offre : Aucun</h3>
                        <h6>Reférent : Aucun</h6>
                    </div>
                    <div class="pricing-price-midd">
                        <div class="pricing-price">
                            <span class="unit">Cahier de charge = </span>Aucun<br>
                            <span class="unit">Grille de cotation = </span>Aucun
                        </div>
                        <p>Obtenu 00 | Pondéré sur 00</p>
                    </div>
                    <div class="pricing-bottom">
                        <span class="label label-danger h6">Commentaire</span>
                        <div class="divcod5"></div>
                        <span class="label label-success">Par le comité d'évaluation</span>
                        <div class="divcod5"></div>
                        <p>Sur le Cahier de Charge : Aucun</p>
                        <p>Sur la Grille de Cotation : Aucun</p>
                        <div class="divcod5"></div>
                        <span class="label label-success">Par le Prescripteur / Acheteur</span>
                        <div class="divcod5"></div>
                        <p>Sur le Cahier de Charge : Aucun</p>
                        <p>Sur la Grille de Cotation : Aucun</p>
                        <div class="divcod5"></div>
                        <ul>
                            <li><b>Cahier de Charge</b> : <span class="badge"> Aucun </span></li>
                            <li><b>Grille de Cotation</b>: <span class="badge"> Aucun </span></li>
                            <li><b>Cumul</b>: <span class="badge alert-success"> Aucun </span></li>
                        </ul>
                        <a class="btn black" href="#" onclick="javascript:location.reload();" title="Rafraichir">Actualiser</a>
                    </div>
                </div>
            </div>
        <?php }
    }
    elseif($type == 'other'){}
?>