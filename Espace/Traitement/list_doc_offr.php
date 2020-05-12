<?php
require_once('../../functions/pdo_connect.php');
require_once('../../define/define.php');
require_once('../../functions/encode_utf8.php');
require_once('../../functions/extension.php');
require_once('../../callback.php');
// Needing class
require_once('../../php/class/Mysql_query.class.php');
require_once('../../php/class/Fourniss.class.php');
require_once('../../php/class/Manager.class.php');
// Fin

require_once('../../functions/function.traitement.php');
date_default_timezone_set('UTC');
setlocale(LC_TIME, 'fr_FR.UTF8','fra');
   extract($_POST);
    $appel = isset($_POST['idt4']) ? htmlentities(addslashes($_POST['idt4'])) : '';
    $agree = isset($_POST['ft4']) ? htmlentities(addslashes($_POST['ft4'])) : '';
    $type = isset($_POST['type']) ? htmlentities(addslashes($_POST['type'])) : '';
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    $verifData = "";
    $valid2 = "";
    $tableP = piece_appel;
    $tableO = offre;
    $tableC = fournisseur_consulte;
    $tableD = document_appel;
    $tableG = "";


$ref = "";
$type_o = "";
$cate = "";
$speci = "";
$deb = "";
$fin = "";
$par = "";
$libelle = "";


        if($type == 'view1') {

            $query = $bdd->prepare("SELECT " . $tableO . ".ID_APPEL, " . $tableO . ".ID_TYPE_O, " . $tableO . ".CATEGORIE,
                                 " . $tableO . ".SPECIFICATION, " . $tableO . ".REF, " . $tableO . ".LIBELLE, " . $tableO . ".DATE_D, " . $tableO . ".DATE_F, " . $tableO . ".CREER_PAR
                                  FROM " . $tableO . "," . $tableC . "
                                  WHERE " . $tableO . ".ID_APPEL = " . $tableC . ".ID_APPEL 
                                  AND " . $tableC . ".ID_AGRE = :agree 
                                  AND " . $tableO . ".ID_APPEL = :appel
                                  AND " . $tableC . ".MODE = :mode
                                  AND " . $tableO . ".MODE = :mode  
                                  ORDER BY " . $tableO . ".ID_APPEL");
            $query->bindParam(':agree', $agree, PDO::PARAM_INT);
            $query->bindParam(':appel', $appel, PDO::PARAM_INT);
            $query->bindParam(':mode', $mode, PDO::PARAM_INT);
            $query->execute();
            $fetching = $query->fetchAll(PDO::FETCH_BOTH);
            $rowCount = $query->rowCount();

            foreach ($fetching as $donnes) {
                $appel = $donnes[0];
                if ($donnes[1] == 1) {
                    $type_o = "Standard";
                } elseif ($donnes[1] == 2) {
                    $type_o = "PI";
                } elseif ($donnes[1] == 3) {
                    $type_o = "Import";
                } elseif ($donnes[1] == 4) {
                    $type_o = "Projet";
                } elseif ($donnes[1] == 5) {
                    $type_o = "BTP";
                } elseif ($donnes[1] == 6) {
                    $type_o = "Service Généraux";
                }
                $ref = $donnes[4];
                $cate = $donnes[2];
                $speci = $donnes[3];
                $deb = $donnes[6];
                $fin = $donnes[7];
                $par = $donnes[8];
                $libelle = $donnes[5];
            }
            $chc = 'CHC';
            $req = $bdd->prepare("SELECT ID_PIECE_FA FROM " . $tableP . " WHERE ID_APPEL = :appel AND TYPES = :types");
            $req->bindParam(':appel', $appel, PDO::PARAM_INT);
            $req->bindParam(':types', $chc, PDO::PARAM_STR);
            $req->execute();
            $data_p = $req->fetchAll(PDO::FETCH_BOTH);
            foreach ($data_p as $value) {
                $piece_a = $value[0];
            }
            if ($rowCount > 0) {

                ?>
                <!-- detail ao -->
                <h1 class="details_title">Appel d'Offre : <?php echo $libelle; ?></h1>
                <ul>
                    <li><span>Ref</span> : <?php echo $ref; ?></li>
                    <li><span>Type</span> : Achat <?php echo $type_o; ?></li>
                    <li><span>Catégorie</span> : Achat <?php echo $cate; ?></li>
                    <li><span>Spécification</span> : <?php echo $speci; ?></li>
                    <li><span>Date Debut</span> : <?php echo $deb; ?></li>
                    <li><span>Date Fin</span> : <?php echo $fin; ?></li>
                    <li><span>Par l'achéteur</span> : <?php echo $par; ?></li>
                </ul>
                |
                <!-- up-champ -->
                <tr>
                    <td><p class="text-capitalize text-primary">Identifiant</p></td>
                    <td><input type="text" name="iden" required class="form-control" placeholder="ex:APP-000"/></td>
                </tr>
                <tr>
                    <td><p class="text-capitalize text-primary">Mot de passe</p></td>
                    <td><input type="password" name="pass" required class="form-control" value=""/></td>
                </tr>
                <input type="hidden" name="type" value="view2">
                <input type="hidden" name="agree" value="<?php echo $agree; ?>">
                <input type="hidden" name="appel" value="<?php echo $appel; ?>">
            <?php }
        }

        elseif($type == 'view2'){
            $piece_a = 0;
            $type_o =0;
            //if(isset($_POST['identif-lunch'])){

            $iden = htmlentities(addslashes($_POST['iden']));
            $pass = htmlentities(addslashes($_POST['pass']));
            $hashPass = hash('sha1',$pass );
            $agree = htmlentities(addslashes($_POST['agree']));
            $appel_p = htmlentities(addslashes($_POST['appel']));

            $query2 = $bdd->prepare("SELECT ID_CONSF 
                                  FROM " . $tableC . "
                                  WHERE ID_APPEL = :appel
                                  AND ID_AGRE = :agree
                                  AND IDEN = :iden
                                  AND MDP = :pass
                                  AND MODE = :mode");
            $query2->bindParam(':agree', $agree, PDO::PARAM_INT);
            $query2->bindParam(':appel', $appel_p, PDO::PARAM_INT);
            $query2->bindParam(':iden', $iden, PDO::PARAM_STR);
            $query2->bindParam(':pass', $hashPass, PDO::PARAM_STR);
            $query2->bindParam(':mode', $mode, PDO::PARAM_INT);
            $query2->execute();
            $rowCount2 = $query2->rowCount();

            if($rowCount2>0){
                
                $query = $bdd->prepare("SELECT " . $tableO . ".ID_APPEL, " . $tableO . ".ID_TYPE_O, " . $tableO . ".CATEGORIE,
                                 " . $tableO . ".SPECIFICATION, " . $tableO . ".REF, " . $tableO . ".LIBELLE, " . $tableO . ".DATE_D, " . $tableO . ".DATE_F, " . $tableO . ".CREER_PAR
                                  FROM " . $tableO . "," . $tableC . "
                                  WHERE " . $tableO . ".ID_APPEL = " . $tableC . ".ID_APPEL 
                                  AND " . $tableC . ".ID_AGRE = :agree 
                                  AND " . $tableO . ".ID_APPEL = :appel
                                  AND " . $tableC . ".MODE = :mode
                                  AND " . $tableO . ".MODE = :mode  
                                  ORDER BY " . $tableO . ".ID_APPEL");
                $query->bindParam(':agree', $agree, PDO::PARAM_INT);
                $query->bindParam(':appel', $appel_p, PDO::PARAM_INT);
                $query->bindParam(':mode', $mode, PDO::PARAM_INT);
                $query->execute();
                $fetching = $query->fetchAll(PDO::FETCH_BOTH);
                $rowCount = $query->rowCount();
                foreach ($fetching as $donnes) {
                    $appel_p = $donnes[0];
                    $type_o = $donnes[1];
                }
                $chc = 'CHC';
                $req = $bdd->prepare("SELECT ID_PIECE_FA FROM " . $tableP . " WHERE ID_APPEL = :appel AND TYPES = :types");
                $req->bindParam(':appel', $appel_p, PDO::PARAM_INT);
                $req->bindParam(':types', $chc, PDO::PARAM_STR);
                $req->execute();
                $data_p = $req->fetchAll(PDO::FETCH_BOTH);
                foreach ($data_p as $value) {
                    $piece_a = $value[0];
                }
                ?>
                <!--Zone verif-access -->
                <ul>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </ul>
                <p><?php echo date('d/m/Y');?></p>
|
                <!--zone verif-info -->
                <p>Vos informations sont correctes vous pouvez continuer les traitements.</p>
                <a href="#">Accès autorisé</a>
|
                <!--rest_post -->
                <div class="form-input">
                    <label class="badge"><i class="fa fa-file-word-o fa-2x"></i>  Cahier de Charge</label>
                    <input class="form-control" required type="file" name="cahier[]" id="cahier">
                </div>
                <div class="form-input">
                    <label class="badge"><i class="fa fa-file-excel-o fa-2x"></i>  Grille de cotation</label>
                    <input class="form-control" required type="file" name="grille[]" id="grille">
                </div>
                <div class="details_title">
                    <p class="alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> Cette action est irreversible. Voulez vous continuer?
                    </p>
                </div>
                <input type="hidden" name="type_o" value="<?php echo $type_o;?>">
                <input type="hidden" name="agree" value="<?php echo $agree;?>">
                <input type="hidden" name="appel" value="<?php echo $appel_p;?>">
                <input type="hidden" name="piece_doc" value="<?php echo $piece_a;?>">
    <?php }
            //}
        }
        elseif($type == 'set-update'){
            $manager = new Manager($bdd);
            $supplier = new Fourniss($bdd);
            $mode = 1;

            //if(isset($_POST['charger'])) {

                $directory = "files/files_upload_ao/";
                $content_types_list = mimeTypes();

                $idcomp = htmlentities(addslashes($_POST['fcli']));
                

                for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {

                    $nameDirec = "";

                    if(!empty($_FILES['upload']['name'][$i]) && !empty($_POST['piece'])){

                        $id_Piece = htmlentities(addslashes($_POST['piece'][$i]));

                        $browsing = array('name' => $_FILES['upload']['name'][$i], 'temp' => $_FILES['upload']['tmp_name'][$i], 'doc' => $directory, 'mime' => $content_types_list);
                        $nameDirec = $manager->upload_Multiple($browsing);
                        $req = $bdd->prepare("INSERT INTO ". document_appel . "(ID_PIECE_FA, ID_AGRE, LIBELLE, MODE) VALUES (?,?, ?, 1)");
                        $req->bindValue(1, $id_Piece, PDO::PARAM_INT);
                        $req->bindValue(2, $idcomp, PDO::PARAM_INT);
                        $req->bindValue(3,$nameDirec ,PDO::PARAM_STR);
                        $req->execute();
                        $req->closeCursor();
                        $verifData = $req;
                    }
                }

                if ($verifData !== '' ){
                    print json_encode(array('resultat' => 'ok'), JSON_NUMERIC_CHECK);
                }
                else {
                    print json_encode(array('resultat' => 'none'), JSON_NUMERIC_CHECK);
                }
            //}
            
        }
?>