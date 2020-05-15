<?php

// Set level for listing
// Hydrating method
$donnees = array(
    'champs' => "ID_DOM_A, LIBELLE",
    'table' => domaine,
    'where' => "MODE = :mode",
    'tri' => "ORDER BY ID_DOM_A ASC",
);

$binding = array(':mode' => $mode);

$getting = new Manager($bdd);
$getting->hydrate($donnees);
$getting->select($binding);

if (!empty($auth)) {
    $verif_data = array(
        'champs' => "*",
        'table' => demandeur,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_CMPT ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $personal = $manager->listAgrement($checking)[0];

    unset($verif_bind, $verif_data, $checking);

    $verif_data = array(
        'champs' => "*",
        'table' => detail_compte,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_DET_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $detail_compte = $manager->listAgrement($checking)[0];

    unset($verif_bind, $verif_data, $checking);
}
?>
<?php if (!empty($auth)): ?>
<div class="container-fluid">
            <h2>Modifier mes Reglages</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <form class="form-chargers card text-center border border-light p-5" name="form-chg" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
                                                <input name="update" type="hidden" value="Modifier" />
                                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
                                                <input type="hidden" name="zone" value="compte">
                                                <p class="h4 mb-4">Changer les informations</p>
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                                <label class="text-primary">Domaine</label>
                                                                                <select name="domaine" required class="form-control">
                                                                                    <option> Listes des Domaines</option>
                                                                                    <?php

                                                                                    $select = $idDom;
                                                                                    $nivo = 'two';
                                                                                    $getting->derouler($nivo, $select);
                                                                                    //
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                                <label class="text-primary">Email</label>
                                                                                <input type="email" required name="email" value="<?= $personal['EMAIL'] ?>" class="form-control" placeholder="Utilisateur@mail.com" value="" />
                                                                            </div>
                                                    </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="text-primary ">Mot de Passe</label>
                                                        <input type="password" required name="pass" id="pass" class="form-control" placeholder="**********" value="" />
                                                    </div>
                                                   
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="text-primary">Confirmation</label>
                                                        <input type="password" required name="conf_pass" id="conf_pass" class="form-control" value="" />
                                                    </div>

                                                </div>
                                            </div>
                                                <div class="form-submit">
                                                    <input type="submit" class="btn main-bg bg-color-primary my-4 btn-block" value="Modifier"/>
                                                </div>
                                            </form>
                </div>
                <div class="col-md-6">
                <form class="form-chargers card text-center border border-light p-5" name="form-chg" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
                                            <input name="update" type="hidden" value="Modifier" />
                                            <input type="hidden" name="zone" value="detCompte">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Détails de l'activité</label>
                                                        <textarea id="det_dom" rows="3" class="form-control" name="detail_dom"><?= $detail_compte['DETAILS_DOM'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divcod15"></div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Nom Charger</label>
                                                        <input type="text" value="<?= $detail_compte['NOM_CHARGER'] ?>" required class="form-control" name="nom_charger" placeholder="Nom du Charger du compte" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Prénoms Charger du Compte</label>
                                                        <input type="text" required value="<?= $detail_compte['PRENOMS_CHARGER'] ?>" class="form-control" name="prenom_charger" placeholder="Prénoms du Charger du compte" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Raison de Votre Inscription</label>
                                                        <textarea required  class="form-control" rows="3" name="raison"><?= $detail_compte['RAISON_FRS'] ?></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="divcod15"></div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Poste Charger</label>
                                                        <input type="text" value="<?= $detail_compte['POSTE'] ?>" required class="form-control" name="Poste_charger" placeholder="Poste du Charger du compte" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Email Charger</label>
                                                        <input type="email" value="<?= $detail_compte['EMAIL'] ?>" class="form-control" name="email_charger" placeholder="Charger@compte.com" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-submit">
                                                <input type="submit" class="btn main-bg bg-color-primary btn-lg" value="Modifier"/>
                                            </div>
                                        </form>
                </div>
            </div>
          </div>
    <?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>

