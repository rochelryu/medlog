<?php
// Hydrating and check this Approval informations in Data Base
$isNewUser = false;
if (!empty($auth)) {
	$verif_data = array(
		'champs' => "a.ID_AGR, a.LIBELLE, a.DATE_C, d.LIBELLE DOM_A, p.DATE_POST",
		'table' => postuler.' p INNER JOIN '.agrement.' a ON a.ID_AGR = p.ID_AGR INNER JOIN '.domaine.' d ON d.ID_DOM_A = a.ID_DOM_A',
		'where' => "p.ID_CMPT = :comp AND d.MODE = :mode AND a.MODE = :mode AND p.MODE = :mode AND (a.DATE_C >= :dates OR a.DATE_C = 'Illimit&eacute;')",
		'tri' => "ORDER BY p.ID_AGR DESC");
	$verif_bind = array(
		':comp' => $auth['user'],
		':dates' => date('Y-m-d'),
		':mode' => $mode
	);
	$checking = array($verif_data, $verif_bind);
	// Get return object in $fetchDatas
	$fetchApproval = $manager->listAgrement($checking);
	unset($verif_bind, $verif_data, $checking);

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
	$verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Maj agrement',);
	$checking = array($verif_data, $verif_bind);
	// Get return object in $fetchDatas
	$fetchNewEntrie = $manager->listAgrement($checking);
	if (empty($fetchNewEntrie)) {
		$isNewUser = true;
		$req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
								$req->bindValue(1,$auth['user'],PDO::PARAM_INT);
								$req->bindValue(2,'Maj agrement' ,PDO::PARAM_STR);
								$req->execute();
								$req->closeCursor();
	}
	unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);
}
$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$id = (int) htmlspecialchars($_GET['id']);
    $verif_data = array(
		'champs' => "pfa.ID_PIECE_FD, pfa.ID_AGR, pfa.ID_PIECE, pa.LIBELLE, a.LIBELLE NAME",
		'table' => piece_fournir_agrement.' pfa INNER JOIN '.piece_agrement.' pa ON pa.ID_PIECE = pfa.ID_PIECE INNER JOIN '.agrement.' a ON a.ID_AGR = pfa.ID_AGR',
		'where' => "pfa.ID_AGR = :agr AND pa.MODE = :mode AND pfa.MODE = :mode",
		'tri' => "ORDER BY pfa.ID_PIECE_FD DESC");
	$verif_bind = array(
		':agr' => $id,
		':mode' => $mode
	);
	$checking = array($verif_data, $verif_bind);
	$pieces = $manager->listAgrement($checking);
}
?>
<?php if (!empty($auth)): ?>
	<div class="col-md-12 col-sm-12 p-5">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-header bg-color-primary">
                              <span>Vos Agréments</span>
                            </div>
                            <ul class="list-group list-group-flush">
							<?php if (empty($fetchApproval)): ?>
								<li class="list-group-item color-grey"> Vous n'avez aucun Agréments</li>
							<?php endif; ?>
								<?php foreach ($fetchApproval as $approval): ?>
									<li class="list-group-item"><a class="<?= $approval['ID_AGR'] == $id ? 'active': '' ?>" href="?p=maj-agrements&id=<?= $approval['ID_AGR']; ?>" ><?= $approval['LIBELLE']; ?>, du <?= $approval['DATE_POST']; ?></a></li>
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
								<form class="text-center card border border-light p-5" id="uploadFile" name="uploadFile" method="post" action="javascript:" enctype="multipart/form-data">

									<h6 class="color-primary mb-4"> <i class="far fa-question-circle"></i> Fichier pour <?= $pieces[0]['NAME']; ?> </h6>

									<?php foreach ($pieces as $piece): ?>
									<div class="col-md-12 mb-4">
										<div class="flexbox flex-column flex-left-center mb-2">
											<div class="custom-control custom-checkbox">
											<?php
												$rep = $bdd->prepare("SELECT * FROM ". document_agrement ."  WHERE ID_AGR = :id_agr AND ID_PIECE_FD = :id_piece_fd AND ID_CMPT =:id_compt");
												$rep->bindParam(':id_agr', $id, PDO::PARAM_INT);
												$rep->bindParam(':id_piece_fd', $piece['ID_PIECE_FD'], PDO::PARAM_INT);
												$rep->bindParam(':id_compt', $agree, PDO::PARAM_INT);
												$rep->execute();
												$nbr = $rep->rowCount();
												if ($nbr > 0) {
													echo '<input type="checkbox" name="piece[]" multiple class="custom-control-input" value="'. $piece['ID_PIECE_FD'] .'" id="piece_'.$piece['ID_PIECE_FD'].'" checked disabled/>';
													echo '<label class="custom-control-label" for="piece_'. $piece['ID_PIECE_FD'].'">'. $piece['LIBELLE']. '</label>';
													echo '</div>';
													echo '<span class="badge badge-warning">Déjà envoyé</span>';
												}
												else {
													echo '<input type="checkbox" name="piece[]" multiple class="custom-control-input" id="piece_'.$piece['ID_PIECE_FD'].'" value="'. $piece['ID_PIECE_FD'] .'" />';
													echo '<label class="custom-control-label" for="piece_'. $piece['ID_PIECE_FD'].'">'. $piece['LIBELLE'].'</label>';
													echo '</div>';
													echo '<input type="file" name="upload[]">';
												}
											?>
										</div>
									</div>
									<?php endforeach; ?>
									<input type="hidden" name="action" value="Espace/Traitement/list_doc_agr.php">
									<input type="hidden" name="agrement" value="<?php echo $id;?>">
									<input type="hidden" name="fcli" value="<?php echo $agree;?>">
									<input type="hidden" name="type" value="set-update" />
									<button class="btn bg-color-primary btn-block my-4" name="go" id="go" type="submit">MISE A JOUR</button>
								</form>
								<?php else : ?>
									<div class="flexbox flex-center half-heigth">
										<h4>Selectionnez un Agrement a mettre a jour</h4>
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
		<h5>Mise à jour Agrement</h5>
		<p class="color-grey">
			La mise à jour de l'Agrement est la dernière etape pour valider sa postulation
			<br>
			Elle consiste a envoyer les fichiers recommander par le fournisseur pour pouvoir adherer au membre a choisir.
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