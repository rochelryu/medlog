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
    $type = isset($_POST['type']) ? htmlentities(addslashes($_POST['type'])) : '';
    $mode = 1;
    $format = 'd/m/Y, H:i:s';
    $date = date($format);
    $verifData = "";
    $table = piece_agrement;
        if($type == 'view'){
            $sth = $bdd->prepare("SELECT LIBELLE FROM ".agrement." WHERE ID_AGR = :agr ");
            $sth->bindParam(':agr', $agr, PDO::PARAM_INT);
            $sth->execute();
            $fetchAgr = $sth->fetchAll(PDO::FETCH_BOTH);
            $NameAgrem = "";
            foreach ($fetchAgr as $donnes){
                $NameAgrem = $donnes[0];
            }

        $req = $bdd->prepare("SELECT ID_PIECE_FD, PIECE FROM ".$table." WHERE ID_AGR = :agr ");
        $req->bindParam(':agr', $agr, PDO::PARAM_INT);
        $req->execute();

            $numRow = $req->rowCount();

            if($numRow>0){
                $data = $req->fetchAll(PDO::FETCH_BOTH);
                ?>
<div class="section-content">
    <h4 class="tap-title active">

        <span class="fa fa-question-circle"></span><a href="#">Fichiers pour l'Agrément : <?php echo $NameAgrem;?></a></h4>
    <p class="help-block">Pour tous fichiers à charger, veuillez cochez les cases correspondantes.</p>
    <?php
    foreach ($data as $value){
    ?>
    <div class="tap-inner">
       <div class="form-group">
           <label class="badge alert-success">
               <input type="checkbox" name="piece[]" multiple id="piece_<?php echo $value[0];?>" class="form-control col-sm-7" value="<?php echo $value[0];?>">
               <?php echo $value[1]?>
            <input type="file" class="form-control" name="upload[]" />
           </label>
         </div>
    </div>
    <?php
    }
    ?>
    <input type="hidden" name="agrement" value="<?php echo $agr;?>">
    <input type="hidden" name="type" value="set-update">

</div>
    <?php        }

        }
        elseif($type == 'set-update'){
        $manager = new Manager($bdd);
        $supplier = new Fourniss($bdd);
        $mode = 1;

            //if(isset($_POST['go'])) {

                $directory = "files/files_upload_dag/";
                $content_types_list = mimeTypes();
                $idcomp = htmlentities(addslashes($_POST['fcli']));
                $agr = htmlentities(addslashes($_POST['agrement']));

                for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {

                        $nameDirec = "";

                        if(!empty($_FILES['upload']['name'][$i]) && !empty($_POST['piece'])){

                            $id_Piece = htmlentities(addslashes($_POST['piece'][$i]));

                            $browsing = array('name' => $_FILES['upload']['name'][$i], 'temp' => $_FILES['upload']['tmp_name'][$i], 'doc' => $directory, 'mime' => $content_types_list);
                            $nameDirec = $manager->upload_Multiple($browsing);
                            $req = $bdd->prepare("INSERT INTO ". document_agrement . "(ID_AGR, ID_PIECE_FD, ID_CMPT, LIBELLE, MODE) VALUES (?,?, ?, ?, 1)");
                            $req->bindValue(1,$agr,PDO::PARAM_INT);
                            $req->bindValue(2, $id_Piece, PDO::PARAM_INT);
                            $req->bindValue(3, $idcomp,PDO::PARAM_INT);
                            $req->bindValue(4,$nameDirec ,PDO::PARAM_STR);
                            $req->execute();
                            $req->closeCursor();
                            $verifData = $req;
                        }
                }

                if (!empty($verifData)){
                    print json_encode(array('resultat' => 'ok'), JSON_NUMERIC_CHECK);
                }
                elseif (empty($verifData)) {
                    print json_encode(array('resultat' => 'none'), JSON_NUMERIC_CHECK);
                }
        //    }
            
        }
?>