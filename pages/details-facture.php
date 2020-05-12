<?php
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
                        <table id="table" class="table table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
        <div class="divcod25"></div>
        <div class="row" id="panel-deny">
            <div class="col-md-12 col-sm-12">
                <div class="Block-Case Details">
                    <p>&emsp13;<span class="class="text-danger"">
                        <i class="fa fa-eye-slash fa-2x"></i>
                        Vous devez disposer au minimum d'un bon de commande listé plus haut pour avoir accès a la zone de chargement des fichiers de Facture.<br>Veuillez contactez le service Achat de l'Entreprise pour plus d'informations.</span></p>
                </div>
            </div>
        </div>
        <div class="row" id="panel-access">
            <div class="col-md-12 col-sm-12">
                <form id="form-charger" name="form-chg" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="clt" id="clt" value="" required>
                    <input type="hidden" name="type" id="type" value="facture">
                    <input type="hidden" name="f4t" id="f4t" value="<?php echo $agree;?>">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label class="badge alert-info"> NUM Facture</label>
                            <input type="text" name="code" class="form-control" placeholder="Ex : FACT-<?php echo date('Y');?>/0000">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group">
                            <label class="badge alert-info"> Libéllé</label>
                            <input type="text" name="titre" placeholder="Ex : Facture xxxxxxx xxxx" class="form-control" required value="">
                        </div>
                    </div>
                </div>
                <div class="divcod10"></div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="badge alert-info"><i class="fa fa-file-pdf-o fa-2x"></i> Facture</label>
                            <input type="file" name="facture[]" class="form-control" required >
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
            </div>
        </div>
        <div class="divcod15"></div>
        <div class="row">
            <div class="col-md-12 col-sm-10">
                <div id="alerte">
                    <div align="center" id="reponse_no" class="alert alert-dismissible alert-danger">
                        <form><button type="button" class="close" data-dismiss="alert">×</button></form>
                        <strong><i class="fa fa-frown-o"></i> Alerte :</strong> Chargement du fichier impossible. Verifier le format ou vous avez déjà charger ce fichier
                    </div>
                    <div align="center" id="reponse_yes" class="alert alert-dismissible alert-success">
                        <form><button type="button" class="close" data-dismiss="alert">×</button></form>
                        <strong><i class="fa fa-smile-o"></i> Alerte :</strong> Votre facture a été charger. Nous vous reviendrons bientôt.
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<?php foreach($factures as $facture): ?>
    <?php if ($facture['ETAT'] == 0): ?> 
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
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                <form class="form-charger" action="Espace/Traitement/charge_all_doc.php" method="post" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="clt" id="clt" value="<?= $facture['ID_BC'] ?>">
                                                                                    <input type="hidden" name="type" id="type" value="facture">
                                                                                    <input type="hidden" name="f4t" id="f4t" value="<?php echo $agree;?>">
                                                                                    <div class="md-form mb-5">
                                                                                        <div class="custom-file">
                                                                                                    <input type="file" class="custom-file-input" name="files[]" id="inputGroupFile01"
                                                                                                    aria-describedby="inputGroupFileAddon01" />
                                                                                                    <label class="custom-file-label" for="inputGroupFile01">Joindre ici l'Avenant reçu par mail</label>
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
<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>