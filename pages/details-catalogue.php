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
    $verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Catalogue',);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $fetchNewEntrie = $manager->listAgrement($checking);
    if (empty($fetchNewEntrie)) {
        $isNewUser = true;
        $req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
                                $req->bindValue(1,$auth['user'],PDO::PARAM_INT);
                                $req->bindValue(2,'Catalogue' ,PDO::PARAM_STR);
                                $req->execute();
                                $req->closeCursor();
    }
    unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);

    $verif_data = array(
        'champs' => "ID_CAT_FRS, CODE_CAT, TITRE, AUTORISER, CREER_LE ,MODIFIER_LE",
        'table' => catalogue,
        'where' => "ID_CMPT = :compt AND MODE = :mode",
        'tri' => "ORDER BY ID_CAT_FRS ASC"
    );
    $verif_bind = array(':compt' => $auth['user'],':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    $catalogues = $manager->listAgrement($checking);
    unset($verif_data, $verif_bind, $checking);

    $year = date('Y');
    $mode = 1;
    /*
     * Get Autoset Code Candidat to implement new input for new Supplier
     */
    // Hydrating method data
    $donnees = array(
    'champs' => "COUNT(ID_CAT_FRS)",
    'table' => catalogue,
    'where' => "MODE = :mode",
    'tri' => "ORDER BY ID_CAT_FRS ASC",
);

    $binding = array(':mode' => $mode);
    $call = new Fourniss($bdd);

    // Hydrating and lunch select method

    $call->hydrate($donnees);
    $call->select($binding);
    // Get Code Compte
    $code = $call->codeCatalogue($year);
}
?>
<?php if (!empty($auth)): ?>
<script>
    $(function () {
        $("#panel-control").hide();
        $("#access").hide();
        $("#deny").hide();
        //
        $("#post-update").hide();
        $("#reponse_no2").hide();
        $("#reponse_yes2").hide();
        //
        $("#post-create").hide();
        $("#reponse_no").hide();
        $("#reponse_yes").hide();


        var $table = $('#table');
        $table.bootstrapTable({});

        $table.on('check.bs.table', function (e, row) {
            $('#clt').empty();
            $('#clt').val(row.id);
            $("#title").empty();
            $("#title").val(row.titre);
            if(row.Autorize == 1){
                $("#panel-control").show('slow');
                window.setTimeout(function() {$("#access").show('slow');}, 2000);
            }else if(row.Autorize == 0){
                $("#panel-control").show('slow');
                window.setTimeout(function() {$("#deny").show('slow');}, 2000);
            }
        });

    });

</script>

<div class="container  mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="background double"><span>Gestion des fichiers pour le Catalogue</span></h2>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="description-product">
                        <div class="item"><a href="#"><img src="assets/pictures/files.svg" class="width-20" alt=""></a></div>
                        <span class="badge badge-danger">Nous vous prions de bien vouloir respecter ce format.</span>
                    </div>
                </div>

                <div class="col-md-5 col-sm-5">
                    <span class="badge badge-warning">Veuillez Télécharger les Fichiers a remplir avant Création ou Mise à jour du Catalogue.</span>
                    <div class="description-product">
                        <p>&emsp;<b>&bull;</b> Vous aurez a créer un Cataloque s'il n'existe pas. remplire le Fichiers Excel principale et le secondaire details du fichiers principales. ensuite les joindres.
                        <br>&emsp;<b>&bull;</b> Pour la Mise à jour du Catalogue se fait par autorisation de L'achéteur en charge de votre Domaine d'Activité. il vous autorisera a charger les deux Fichiers correspondants afin de faire la Mise à Jour.</p>
                    </div>
                    <div class="form-submit">
                        <div class="form-group">
                            <label class="color-primary"> Télecharger les Fichiers du Catalogue</label>
                            <a id="lunch1" class="btn bg-color-primary"> <i class="far fa-file-excel"></i> Articles</a>
                           <a id="lunch2" class="btn bg-color-primary"> <i class="far fa-file-excel"></i> Details Articles</a>
                        
                        </div>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
        <div class="divcod15"></div>
        <hr>
        <div class="divcod5"></div>
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <h3>Zone de traitement</h3>
                <div class="Shop-Tab" role="tabpanel">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#homet" role="tab" aria-controls="homet"
                        aria-selected="true">Mise à jour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                        aria-selected="false">Nouveau</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="homet" role="tabpanel" aria-labelledby="home-tab">
                    <div class="Block-Case Specifications">
                                <div class="row card">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table id="table" class="table table-bordered">
                                                <thead>
                                                    <th>CODE</th>
                                                    <th>TITRE</th>
                                                    <th>AUTORISATION</th>
                                                    <th>CREATION</th>
                                                    <th>MISE À JOUR</th>
                                                    <th>ACTION</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($catalogues as $catalogue): ?>
                                                        <tr>
                                                        
                                                            <td><?= $catalogue['CODE_CAT'] ?></td>
                                                            <td><?= $catalogue['TITRE'] ?></td>
                                                            <td><?= ($catalogue['AUTORISER'] == 0) ? '<span class="badge badge-warning">Non autorisé</span>' : '<span class="badge badge-success">Autorisé</span>' ?></td>
                                                            <td><?= $catalogue['CREER_LE'] ?></td>
                                                            <td><?= ($catalogue['MODIFIER_LE'] == '') ? 'Pas encore mise a jour' : $catalogue['MODIFIER_LE'] ?></td>
                                                            <td>
                                                                <?php if ($catalogue['AUTORISER'] == 1): ?> 
                                                                    <a href="" class='btn btn-info' data-toggle="modal" data-target="#modalLoginForm<?= $catalogue['ID_CAT_FRS'] ?>">Mettre a jour</a> 
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row card">
                                <div class="col-md-12 col-sm-12" id="panel-control">
                                    <h4>Nouveau Catalogue</h4>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="Block-Case Details">
                                        <p>&emsp13;<span class="text-danger">
                                            <i class="fa fa-exclamation-triangle fa-2x"></i>
                                            Veuillez a respecter toute les directives énoncées pour remplir les fichiers afin de permettre la prise en compte de votre demande.<br>Veuillez contactez le service Achat de l'Entreprise pour plus d'informations.</span></p>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <form id="form-create" name="form-cr" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="catalogue">
                                        <input type="hidden" name="group" value="0">
                                        <input type="hidden" name="f4t" id="f4t" value="<?php echo $auth['user'];?>">
                                        <input type="hidden" name="domaine" id="dom" value="<?php echo $idDom;?>">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="badge badge-dark"> CODE Catalogue</label>
                                                    <input type="text" name="code" class="form-control" readonly value="<?php echo $code;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="form-group">
                                                    <label class="badge badge-dark"> Nouveau Titre</label>
                                                    <input type="text" name="titre" placeholder="Ex : Mon Catalogue <?php echo date('Y');?> IBC" class="form-control" required value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divcod10"></div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="badge badge-dark"><i class="fa fa-file-excel fa-2x"></i> Article Catalogué</label>
                                                    <input type="file" name="article[]" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="badge badge-dark"><i class="fa fa-file-excel fa-2x"></i> Details Article</label>
                                                    <input type="file" name="det_article[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="badge badge-dark"><i class="fa fa-file-pdf fa-2x"></i> / <i class="fa fa-file-word fa-2x"></i> Catalogue PDF/WORD à jour.</label>
                                                    <input type="file" name="catalogue[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divcod10"></div>
                                        <div class="row">
                                            <div class="col-md-10 col-sm-10">
                                                <div class="form-submit">
                                                    <input type="submit" name="update" value="Charger" class="btn bg-color-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="post-create">
                                        <div align="center" id="reponse_no" class="alert alert-dismissible alert-danger">
                                            <form><button type="button" class="close" data-dismiss="alert">×</button></form>
                                            <strong><i class="fa fa-frown-o"></i> Alerte :</strong> La Mise à Jour à échouer. un problème est survenue. Veuillez verifier le format des fichiers et réessayer.
                                        </div>
                                        <div align="center" id="reponse_yes" class="alert alert-dismissible alert-success">
                                            <form><button type="button" class="close" data-dismiss="alert">×</button></form>
                                            <strong><i class="fa fa-smile-o"></i> Alerte :</strong> Mise à Jour éffectué!!! Vous ne pourrez plus changer ces informations jusqu'a nouvelle ordre.
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>


                </div>
            </div>
        </div>

    </div>

<?php foreach($catalogues as $catalogue): ?>
<?php if ($catalogue['AUTORISER'] == 1): ?> 
<div class="modal fade right" id="modalLoginForm<?= $catalogue['ID_CAT_FRS'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-side modal-bottom-right" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h4 class="modal-title w-100 font-weight-bold">Mettre a jour <?= $catalogue['TITRE'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </div>
                                                        <div class="modal-body mx-3">
                                                        <form id="form-update" name="form-up" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="code" id="code" value="<?= $catalogue['CODE_CAT'] ?>">
                                            <input type="hidden" name="type" id="type" value="catalogue">
                                            <input type="hidden" name="group" id="group" value="1">
                                            <input type="hidden" name="f4t" id="f4t" value="<?php echo $auth['user'];?>">
                                            <input type="hidden" name="domaine" id="dom" value="<?php echo $idDom;?>">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                    <label class="badge badge-dark">Titre</label>
                                                    <input type="text" name="titre" id="title" class="form-control" required value="<?= $catalogue['TITRE'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divcod10"></div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="badge badge-dark"><i class="fa fa-file-excel fa-2x"></i> Article Catalogué</label>
                                                        <input type="file" name="article[]" class="form-control" required >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="badge badge-dark"><i class="fa fa-file-excel fa-2x"></i> Details Article</label>
                                                        <input type="file" name="det_article[]" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="badge badge-dark"><i class="fa fa-file-pdf fa-2x"></i> / <i class="fa fa-file-word fa-2x"></i> Catalogue PDF/WORD à jour.</label>
                                                        <input type="file" name="catalogue[]" class="form-control" required>
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
                                            <?php endif; ?>
                                        <?php endforeach; ?>


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
		<h5>Modifier un Catalogue</h5>
		<p class="color-grey">
			Vous pouvez voir ici vos catalogue et le mettre a jour si neccessaire
			<br>
			Il vous suffit de cliquer sur le bouton "METTRE A JOUR" et une fenêttre s'ouvrira
			<br>
			Ensuite envoyer le document pdf de l'avenant en cliquant sur choisir
            <br>
            Puis, une fois l'action précedente terminée avec succès cliquez sur charger. 
			<span class="badge badge-danger">Format du fichier (PDF)</span>
        </p>
        <h5>Creer un Catalogue</h5>
		<p class="color-grey">
			Vous pouvez creer un catalogue si neccessaire
			<br>
			Il vous suffit de cliquer sur le bouton "Nouveau" et une fenêttre s'ouvrira
			<br>
			Ensuite renseigner le formulaire correctement et envoyer les documents Excel et Word du catalogue
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

