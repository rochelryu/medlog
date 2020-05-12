<?php
// Hydrating and check this Approval informations in Data Base
$isSkiped = true;
$isNewUser = false;
if (!empty($auth)) {
    $id = isset($_GET['id']) && !empty($_GET['id']) ? (int)htmlspecialchars($_GET['id']) : null;

    $verif_data = array(
    'champs' => "a.ID_AGR, a.LIBELLE, a.DATE_C, d.LIBELLE DOM_A",
    'table' => agrement.' a INNER JOIN '.domaine.' d ON d.ID_DOM_A = a.ID_DOM_A',
    'where' => "a.ID_AGR = :id AND .d.MODE = :mode AND a.MODE = :mode",
    'tri' => "ORDER BY ID_AGR DESC");
    $verif_bind = array(':id' => $id, ':mode' => $mode);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $approval = $manager->listAgrement($checking)[0];
	unset($verif_bind, $verif_data, $checking);

	$verif_data = array(
		'champs' => "id",
		'table' => new_entries,
		'where' => "id_compt = :id_compt AND section = :section",
		'tri' => "ORDER BY id ASC LIMIT 10");
	$verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Postuler agrement',);
	$checking = array($verif_data, $verif_bind);
	// Get return object in $fetchDatas
	$fetchNewEntrie = $manager->listAgrement($checking);
	if (empty($fetchNewEntrie)) {
		$isNewUser = true;
		$req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
								$req->bindValue(1,$auth['user'],PDO::PARAM_INT);
								$req->bindValue(2,'Postuler agrement' ,PDO::PARAM_STR);
								$req->execute();
								$req->closeCursor();
	}
	unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);

	$dates = ($approval['DATE_C'] == 'Ouvert') ? ['0', '0', '999999999'] : explode('/', $approval['DATE_C']);
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
                <div class="flexbox allwidth flex-center">
				<div class="row mb-5 p-5">
                                        <div class="col-md-6 col-lg-6">
											<div class="card">
												<div class="card-header">
													<h4 class="color-primary"><?= $approval['LIBELLE']; ?></h4>
												</div>
												<div class="card-body">
													<blockquote class="blockquote mb-0">
													<footer class="blockquote-footer">Date cloture : <b><?= $approval['DATE_C']; ?></b></footer>
													</blockquote>
													<input type="hidden" name="id_agrement" id="idAgrement" value="<?= $approval['ID_AGR']; ?>">
													<input type="hidden" name="id_user" id="idUser" value="<?= $auth['user']; ?>">
													<?php if (!$isSkiped): ?>
														<button class="btn bg-color-primary waves-effect" id="postAgrement">POSTULER</button>
													<?php endif; ?>
												</div>
												<div class="card-footer">
													<div class="flexbox flex-space-between">
													<p><i class="fas fa-map-marker-alt"></i> <?= $approval['DOM_A']; ?></p>
													<p><i class="fas fa-thumbtack"></i> <?= $approval['DOM_A']; ?></p>
													</div>
												</div>
											</div>
										</div>
                                        <div class="col-lg-4 col-md-4">
											<img src="./assets/pictures/agrement.svg" class="img-fluid"
												alt="Sample project image" />
                                      </div>
                </div>
              </div>
			</div>

<?php if ($isNewUser): ?>
<div class="modal show active  fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-bottom-left" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color-primary w-100" id="myModalLabel">GUIDE</h4>
      </div>
      <div class="modal-body">
		<h5>Postuler Agrement</h5>
		<p class="color-grey">
			Il est possible de postuler a un agrement uniquement lorsqu'on sa date de cloture ne soit pas encore depassée ou signalé comme ouverte
			<br>
			Une fois un Agrement postuler, il vous faudra mettre a jour cet agrement afin de terminer votre demande de postulation.
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