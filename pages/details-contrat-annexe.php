<?php
$isNewUser = false;
if (!empty($auth)) {
    $verif_data = array(
    'champs' => "ID_AGRE",
    'table' => agrees,
    'where' => "ID_CMPT = :comp AND MODE = :mode",
    'tri' => "ORDER BY ID_AGRE ASC"
);
    $verif_bind = array(':comp' =>$auth['user'],':mode' => $mode);
    $checking = array($verif_data, $verif_bind);
    $agree = $supplier->recupAgree($checking);
    unset($verif_data, $verif_bind, $checking);

    $verif_data = array(
        'champs' => "ID_CONTRAT, CODE, LIBELLE, ETAT, DATE_DEBUT, DATE_CHARGE",
        'table' => contrat,
        'where' => "ID_AGRE = :agree AND MODE = :mode",
        'tri' => "ORDER BY ID_CONTRAT ASC"
    );
    $verif_bind = array(':agree' => $agree,':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    $contrats = $manager->listAgrement($checking);
    unset($verif_data, $verif_bind, $checking);

    $verif_data = array(
        'champs' => "id",
        'table' => new_entries,
        'where' => "id_compt = :id_compt AND section = :section",
        'tri' => "ORDER BY id ASC LIMIT 10");
    $verif_bind = array(':id_compt' => $auth['user'], ':section' => 'contrat annexe',);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $fetchNewEntrie = $manager->listAgrement($checking);
    if (empty($fetchNewEntrie)) {
        $isNewUser = true;
        $req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
                                $req->bindValue(1,$auth['user'],PDO::PARAM_INT);
                                $req->bindValue(2,'contrat annexe' ,PDO::PARAM_STR);
                                $req->execute();
                                $req->closeCursor();
    }
    unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);

}
?>
<?php if (!empty($auth)): ?>


<div class="col-md-12 col-sm-12 p-5 half-heigth">
              <div class="row flexbox flex-center">
                <div class="col-md-12">
                    <h2 class="background double"><span>Gestion des fichiers pour le Contrat et Annexe</span></h2>
                </div>
                  <div class="col-md-12 col-sm-12">
                      <div class="col-md-12 col-sm-12">
                          <div class="description-product">
                              <div class="item"><a href="#"><img src="assets/pictures/files.svg" class="width-20" alt=""></a></div>
                              <span class="badge badge-danger">Nous vous prions de bien vouloir respecter ce format.</span>
                              
                          </div>
                      </div>

                        <div class="col-md-12 col-sm-12 card">
                            <div class="table-responsive">
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <th>CODE</th>
                                        <th>LIBELLE</th>
                                        <th>ETAT</th>
                                        <th>EDITION</th>
                                        <th>CHARGER LE</th>
                                        <th>ACTION</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach($contrats as $contrat): ?>
                                        <tr>
                                        
                                            <td><?= $contrat['CODE'] ?></td>
                                            <td><?= $contrat['LIBELLE'] ?></td>
                                            <td><?= ($contrat['ETAT'] == 0) ? '<span class="badge badge-warning">Non chargé</span>' : '<span class="badge badge-success">Déjà chargé</span>' ?></td>
                                            <td><?= $contrat['DATE_DEBUT'] ?></td>
                                            <td><?= ($contrat['DATE_CHARGE'] == '') ? 'En attente de chargement' : $contrat['DATE_CHARGE'] ?></td>
                                            <td> 
                                            <?php if ($contrat['ETAT'] == 0): ?> 
                                                <a class='btn btn-info btn-sm' data-toggle="modal" data-target="#modalLoginForm<?= $contrat['ID_CONTRAT'] ?>">Mettre a jour</a> </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  </div>    
              </div>
              
</div>

<?php foreach($contrats as $contrat): ?>
    <?php if ($contrat['ETAT'] == 0): ?> 
<div class="modal fade right" id="modalLoginForm<?= $contrat['ID_CONTRAT'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-side modal-bottom-right" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-center">
                                                                        <h4 class="modal-title w-100 font-weight-bold">Mettre a jour <?= $contrat['CODE'] ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </div>
                                                                    <div class="modal-body mx-3">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                <form class="form-charger" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="clt" id="clt" value="<?= $contrat['ID_CONTRAT'] ?>">
                                                                                    <input type="hidden" name="type" id="type" value="contrat">
                                                                                    <input type="hidden" name="f4t" id="f4t" value="<?php echo $agree;?>">
                                                                                    <div class="md-form mb-5">
                                                                                        <div class="custom-file">
                                                                                                    <input type="file" class="custom-file-input" name="files[]" id="inputGroupFile01"
                                                                                                    aria-describedby="inputGroupFileAddon01" />
                                                                                                    <label class="custom-file-label" for="inputGroupFile01">Joindre ici le contrat reçu par mail</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="md-form mb-5">
                                                                                        <div class="custom-file">
                                                                                                    <input type="file" class="custom-file-input" name="filesA[]" id="inputGroupFile01"
                                                                                                    aria-describedby="inputGroupFileAddon01" />
                                                                                                    <label class="custom-file-label" for="inputGroupFile01">Joindre ici l'annexe au contrat reçu par mail</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="md-form">
                                                                                    <input type="submit" name="identif-lunch" value="Charger" class="btn btn-default">
                                                                                    </div>
                                                                                </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>


<?php if ($isNewUser): ?>
<div class="modal show active  fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color-primary w-100" id="myModalLabel">GUIDE</h4>
      </div>
      <div class="modal-body">
		<h5>Contrat et Annexe</h5>
		<p class="color-grey">
			Vous pouvez voir ici votre contrat et annexe afin de la mettre a jour si neccessaire
			<br>
			Il vous suffit de cliquer sur le bouton "METTRE A JOUR" et une fenêttre s'ouvrira
			<br>
			Ensuite envoyer le document pdf du contrat et celui aussi de l'annexe en cliquant sur choisir
            <br>
            Puis, une fois l'action précedente terminée avec succès cliquez sur charger. 
			<span class="badge badge-danger">Format du fichier (PDF)</span>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm back-guide">OK</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>



<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>
