<?php
// Hydrating and check this Approval informations in Data Base
$isNewUser = false;
$isSkiped = true;
if (!empty($auth)) {
	
$verif_data = array(
    'champs' => "ID_AGRE",
    'table' => agrees,
    'where' => "ID_CMPT = :comp AND MODE = :mode",
    'tri' => "ORDER BY ID_AGRE ASC"
);
$verif_bind = array(':comp' => $auth['user'],':mode' => $mode);
$checking = array($verif_data, $verif_bind);
$agree = $supplier->recupAgree($checking);
unset($verif_data, $verif_bind, $checking);
$verif_data = array(
	'champs' => "o.ID_APPEL, o.REF, o.LIBELLE, o.DATE_D, o.DATE_F, d.LIBELLE DOM_A, p.DATE_POST",
	'table' => postuler_offr.' p INNER JOIN '.offre.' o ON o.ID_APPEL = p.ID_APPEL INNER JOIN '.domaine.' d ON d.ID_DOM_A = o.ID_DOM_A',
	'where' => "p.ID_AGRE = :comp AND d.MODE = :mode AND o.MODE = :mode AND p.MODE = :mode",
	'tri' => "ORDER BY p.ID_POSTULE_O DESC");
$verif_bind = array(
	':comp' => (int)$agree,
	#':dates' => date('Y-m-d'),
	':mode' => $mode
);
#AND (o.DATE_F >= :dates OR o.DATE_F = 'Illimit&eacute;')
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchApproval = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);


$verif_data = array(
	'champs' => "id",
	'table' => new_entries,
	'where' => "id_compt = :id_compt AND section = :section",
	'tri' => "ORDER BY id ASC LIMIT 10");
$verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Maj appel',);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchNewEntrie = $manager->listAgrement($checking);
if (empty($fetchNewEntrie)) {
	$isNewUser = true;
	$req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
							$req->bindValue(1,$auth['user'],PDO::PARAM_INT);
							$req->bindValue(2,'Maj appel' ,PDO::PARAM_STR);
							$req->execute();
							$req->closeCursor();
}
unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);

}
$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$id = (int) htmlspecialchars($_GET['id']);
    $verif_data = array(
		'champs' => "ID_PIECE_FA, ID_APPEL, PIECE, LIBELLE",
		'table' => piece_appel,
		'where' => "ID_APPEL = :agr",
		'tri' => "ORDER BY ID_PIECE_FA DESC");
	$verif_bind = array(
		':agr' => $id,
	);
	$checking = array($verif_data, $verif_bind);
	$pieces = $manager->listAgrement($checking);
	unset($verif_bind, $verif_data, $checking);

	$verif_data = array(
		'champs' => "*",
		'table' => offre,
		'where' => "ID_APPEL = :agr",
		'tri' => "ORDER BY ID_APPEL DESC");
	$verif_bind = array(
		':agr' => $id,
	);
	$checking = array($verif_data, $verif_bind);
	$appel_offre = $manager->listAgrement($checking)[0];
	unset($verif_bind, $verif_data, $checking);

	$dates = ($appel_offre['DATE_F'] == 'Ouvert') ? ['0', '0', '999999999'] : explode('/', $appel_offre['DATE_F']);
	if ( (int)$dates[2] == (int)date('Y') ) {
		if ( (int)$dates[1] == (int)date('m') ) {
			if ((int)$dates[0] >= (int)date('d')) {
				$isSkiped = false;
			}
		}
		else if ((int)$dates[1] > (int)date('m')) {
			$isSkiped = false;
		}
	}
	else if ((int)$dates[2] > (int)date('Y')) {
		$isSkiped = false;
	}
}

?>
<?php if (!empty($auth)): ?>
	<div class="col-md-12 col-sm-12 p-5 half-heigth">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-header bg-color-primary">
                              <span>Vos Appels d'offres</span>
                            </div>
                            <ul class="list-group list-group-flush">
							<?php if (empty($fetchApproval)): ?>
								<li class="list-group-item color-grey"> Vous n'avez aucun Appels d'offres</li>
							<?php endif; ?>
								<?php foreach ($fetchApproval as $approval): ?>
									<li class="list-group-item"><a  href="?p=maj-appels-offre&id=<?= $approval['ID_APPEL']; ?>" ><?= $approval['LIBELLE']; ?>, du <?= $approval['DATE_POST']; ?></a></li>
								<?php endforeach; ?>
                            </ul>
                          </div>
					</div>
                    <div class="col-md-7 col-sm-6">
						<?php if (empty($fetchApproval)): ?>
							<div class="flex-box flex-center allwidth">
								<img src="assets/pictures/nodata.svg" alt="" class="svg-resize" srcset="">
							</div>
							<?php else : ?>
								<?php if ($id != 0): ?>
									<?php if (!$isSkiped): ?>
									<form class="text-center card border border-light p-5" id="uploadFile" name="uploadFile" method="post" enctype="multipart/form-data">

										<h6 class="color-primary mb-4"> <i class="far fa-question-circle"></i> Fichier pour <?= $appel_offre['LIBELLE']; ?> </h6>

										<?php foreach ($pieces as $piece): ?>
										<div class="col-md-12 mb-4 position-relative">
											<div class='position-absolute pos-button-absolute'>
											<button type="button" data-documents="<?= $piece['PIECE'];?>" class="download-maj-appel btn btn-rounded bg-color-primary m-0 pl-3 pr-3 pt-0 pb-0 flexbox flex-center"><i class="fas fa-download"></i><span class='pl-2'>Fichier example</span></button>
											</div>
											<div class="flexbox flex-column flex-left-center mb-2">
												<div class="custom-control custom-checkbox">
												<?php
												$rep = $bdd->prepare("SELECT * FROM ". document_appel ."  WHERE ID_AGRE = :id_agr AND ID_PIECE_FA = :id_piece_fd");
												$rep->bindParam(':id_agr', $agree, PDO::PARAM_INT);
												$rep->bindParam(':id_piece_fd', $piece['ID_PIECE_FA'], PDO::PARAM_INT);
												$rep->execute();
												$nbr = $rep->rowCount();
												if ($nbr > 0) {
													echo '<input type="checkbox" name="piece[]" multiple class="custom-control-input" value="'. $piece['ID_PIECE_FA'] .'" id="piece_'.$piece['ID_PIECE_FA'].'" checked disabled/>';
													echo '<label class="custom-control-label" for="piece_'. $piece['ID_PIECE_FA'].'">'. $piece['LIBELLE']. '</label>';
													echo '</div>';
													echo '<span class="badge badge-warning">Déjà envoyé</span>';
												}
												else {
													echo '<input type="checkbox" name="piece[]" multiple class="custom-control-input" id="piece_'.$piece['ID_PIECE_FA'].'" value="'. $piece['ID_PIECE_FA'] .'" />';
													echo '<label class="custom-control-label" for="piece_'. $piece['ID_PIECE_FA'].'">'. $piece['LIBELLE'].'</label>';
													echo '</div>';
													echo '<input type="file" name="upload[]">';
												}
											?>

											</div>
										</div>
										
										<?php endforeach; ?>
										<div class="col-md-12 flexbox flex-column flex-left-center mb-4 position-relative">
										<div class='position-absolute pos-button-absolute'>
											<button type="button" data-documents="grille.xlsx" class="download-maj-appel btn btn-rounded bg-color-primary m-0 pl-3 pr-3 pt-0 pb-0 flexbox flex-center"><i class="fas fa-download"></i><span class='pl-2'>Fichier example</span></button>
											</div>
											<div class="mb-2">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="piece_grille" multiple class="custom-control-input" id="piece_grille" value="piece_grille">
													<label class="custom-control-label" for="piece_grille">Grille de cotation</label>
												</div>
											</div>
											<div>
												<input type="file" name="grille[]">
											</div>
										</div>
										<input type="hidden" name="action" value="Espace/Traitement/list_doc_offr.php">
										<input type="hidden" name="fcli" value="<?php echo $agree;?>">
										<input type="hidden" name="type_o" value="<?php echo $appel_offre['ID_TYPE_O'];?>">
										<input type="hidden" name="appel" value="<?php echo $appel_offre['ID_APPEL'];?>">
										<input type="hidden" name="type" value="set-update" />
										<button class="btn bg-color-primary btn-block my-4" name="go" id="go" type="submit">MISE A JOUR</button>
									</form>
									<?php else : ?>
										<div class="container card my-5">


											<!--Section: Content-->
											<section class="dark-grey-text">

												<div class="row pr-lg-5">
												<div class="col-md-7 mb-4">

													<div class="view">
													<img src="assets/pictures/delay.svg" class="img-fluid" alt="smaple image">
													</div>

												</div>
												<div class="col-md-5 d-flex align-items-center">
													<div>
													
													<h3 class="font-weight-bold mb-4">Delai depassé</h3>

														<p>Vous ne pouvez plus mettre a jour cet appel d'offre</p>
													</div>
												</div>
												</div>

											</section>
											<!--Section: Content-->


											</div>
									<?php endif; ?>
								<?php else : ?>
									<div class="flexbox flex-center half-heigth">
										<h4>Selectionnez un Appel a mettre a jour</h4>
									</div>
								<?php endif; ?>
							<?php endif; ?>
                    </div>
                </div>
			</div>



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
		<h5>Mise à jour Appel d'offre</h5>
		<p class="color-grey">
			La mise à jour de l'Appel d'offre est la dernière etape pour valider sa postulation
			<br>
			Elle consiste a envoyer le cahier de charge et la grille de cotation recommander par le fournisseur pour pouvoir adherer au membre a choisir.
			<br>
			les fichiers peuvent être chargé en plusieur temps selon votre organisation.
			<br>
			<span class="badge badge-danger">Il est imperatif que tous les fichiers demander par l'anonceur</span>
			<span class="badge badge-danger">soit chargé avant la fin de l'appel d'offre</span>
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