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
        'champs' => "id",
        'table' => new_entries,
        'where' => "id_compt = :id_compt AND section = :section",
        'tri' => "ORDER BY id ASC LIMIT 10");
    $verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Facture',);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $fetchNewEntrie = $manager->listAgrement($checking);
    if (empty($fetchNewEntrie)) {
        $isNewUser = true;
        $req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
                                $req->bindValue(1,$auth['user'],PDO::PARAM_INT);
                                $req->bindValue(2,'Facture' ,PDO::PARAM_STR);
                                $req->execute();
                                $req->closeCursor();
    }
    unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);

    $verif_data = array(
        'champs' => "ID_BC, CODE, IMP_ANAL, CATEGORIE, MONTANT_TTC, DATE_BC ,DATE_LIV",
        'table' => bc,
        'where' => "ID_AGRE = :agree AND MODE = :mode AND CONFIRMER = :conf",
        'tri' => "ORDER BY ID_BC ASC"
    );
    $verif_bind = array(':agree' => $agree,':mode' => 1, ':conf' => 1, );
    $checking = array($verif_data, $verif_bind);
    $factures = $manager->listAgrement($checking);
    unset($verif_data, $verif_bind, $checking);
}
?>
<?php if (!empty($auth)): ?>

<div class="col-md-12 col-sm-12 p-5 half-heigth">
    <div class="row">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
                <h2 class="background double"><span>Gestion des fichiers pour la facture</span></h2>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="col-md-7 col-sm-7">
                    <div class="description-product">
                        <div class="item"><a href="#"><img src="assets/pictures/files.svg" class="width-20" alt=""></a></div>
                        <span class="badge badge-danger">Nous vous prions de bien vouloir respecter ce format.</span>
                        
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 card">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <th>CODE BC</th>
                                <th>CODE SERVICE</th>
                                <th>CATEGORIE</th>
                                <th>MONTANT TTC</th>
                                <th>LIVRAISON</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>
                                                    <?php foreach($factures as $facture): ?>
                                                        <tr>
                                                        
                                                            <td><?= $facture['CODE'] ?></td>
                                                            <td><?= $facture['IMP_ANAL'] ?></td>
                                                            <td><?= $facture['CATEGORIE'] ?></td>
                                                            <td><?= $facture['MONTANT_TTC'] ?></td>
                                                            <td><?= $facture['DATE_LIV'] ?></td>
                                                            <td><a href="" class='btn btn-info' data-toggle="modal" data-target="#modalLoginForm<?= $facture['ID_BC'] ?>">Mettre a jour</a> </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="divcod25"></div>
        <?php if (empty($facture)): ?> 
            <div class="row" id="panel-deny">
                <div class="col-md-12 col-sm-12">
                    <div class="Block-Case Details">
                        <p>&emsp13;<span class="class="text-danger"">
                            <i class="fa fa-eye-slash fa-2x"></i>
                            Vous devez disposer au minimum d'un bon de commande listé plus haut pour avoir accès a la zone de chargement des fichiers de Facture.<br>Veuillez contactez le service Achat de l'Entreprise pour plus d'informations.</span></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    </div>
</div>
<?php if ($isNewUser): ?>
<div class="modal show active fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-left" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color-primary w-100" id="myModalLabel">GUIDE</h4>
      </div>
      <div class="modal-body">
		<h5>Modifier une Facture</h5>
		<p class="color-grey">
			Vous pouvez voir ici vos Facture et le mettre a jour si neccessaire
			<br>
			Il vous suffit de cliquer sur le bouton "METTRE A JOUR" et une fenêttre s'ouvrira
			<br>
			Ensuite remplisser le formulaire convenablement
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
<?php foreach($factures as $facture): ?>
<div class="modal fade right" id="modalLoginForm<?= $facture['ID_BC'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-side modal-bottom-right" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-center">
                                                                        <h4 class="modal-title w-100 font-weight-bold">Mettre a jour <?= $facture['CODE'] ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </div>
                                                                    <div class="modal-body mx-3">
                                                                        <div class="container-fluid">
                                                                        <div class="row" id="panel-access">
            <div class="col-md-12 col-sm-12">
                <form class="form-charger" name="form-chg" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="clt" id="clt" value="<?= $facture['ID_BC'] ?>" required>
                    <input type="hidden" name="type" id="type" value="facture">
                    <input type="hidden" name="f4t" id="f4t" value="<?php echo $agree;?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="badge badge-dark"> NUM Facture</label>
                            <input type="text" name="code" class="form-control" placeholder="Ex : FACT-<?php echo date('Y');?>/0000">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="badge badge-dark"> Libéllé</label>
                            <input type="text" name="titre" placeholder="Ex : Facture xxxxxxx xxxx" class="form-control" required value="">
                        </div>
                    </div>
                </div>
                <div class="divcod10"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="badge badge-dark"><i class="fa fa-file-pdf fa-2x"></i> Facture</label>
                            <input type="file" name="facture[]" class="form-control" required >
                        </div>
                    </div>
                </div>
                <div class="divcod10"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-submit">
                            <input type="submit" name="update" value="Charger" class="btn bg-color-primary">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                        <?php endforeach; ?>
<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>