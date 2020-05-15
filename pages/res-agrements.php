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
    $resApprovals = [];
    unset($verif_bind, $verif_data, $checking);
    
    $verif_data = array(
      'champs' => "id",
      'table' => new_entries,
      'where' => "id_compt = :id_compt AND section = :section",
      'tri' => "ORDER BY id ASC LIMIT 10");
  $verif_bind = array(':id_compt' => $auth['user'], ':section' => 'res-agrements',);
  $checking = array($verif_data, $verif_bind);
  // Get return object in $fetchDatas
  $fetchNewEntrie = $manager->listAgrement($checking);
  if (empty($fetchNewEntrie)) {
      $isNewUser = true;
      $req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
                              $req->bindValue(1,$auth['user'],PDO::PARAM_INT);
                              $req->bindValue(2,'res-agrements' ,PDO::PARAM_STR);
                              $req->execute();
                              $req->closeCursor();
  }
  unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);
}
$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$id = (int) htmlspecialchars($_GET['id']);
	$verif_data = array(
		'champs' => "LIBELLE",
		'table' => agrement,
		'where' => "ID_AGR = :agr",
		'tri' => ""
	);
	$verif_bind = array(
		':agr' => $id
	);
	$checking = array($verif_data, $verif_bind);
	$resApprovals = $manager->listAgrement($checking);
    $NameAgrem = $resApprovals[0]['LIBELLE'];

	unset($verif_bind, $verif_data, $checking);
    $verif_data = array(
		'champs' => "MOYENNE, CREER_PAR, COMMENTAIRE",
		'table' => nts_admin,
		'where' => "ID_AGR = :agr AND ID_CMPT = :cmpt",
		'tri' => "");
	$verif_bind = array(
		':agr' => $id,
		':cmpt' => $auth['user']
	);
	$checking = array($verif_data, $verif_bind);
	$resApprovals = $manager->listAgrement($checking);
	unset($verif_bind, $verif_data, $checking);
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
							  <?php foreach ($fetchApproval as $approval): ?>
								<li class="list-group-item"><a class="<?= $approval['ID_AGR'] == $id ? 'active': '' ?>" href="?p=res-agrements&id=<?= $approval['ID_AGR']; ?>"><?= $approval['LIBELLE']; ?>, du <?= $approval['DATE_POST']; ?></a></li>
							<?php endforeach; ?>
                            </ul>
                          </div>
                    </div>
                    <div class="col-md-7 col-sm-6">
                      <div class="container my-5">

                        <section class="half-heigth">
						<?php if ($id != 0): ?>
                          
                          <div class="card mb-4">
                            
                            <div class="row">
                      
                              <div class="col-md-6 flexbox flex-center allheigth">
                                <img class="result_svg" src="assets/pictures/views.svg" alt="project image">
                              </div>
                      
                              <div class="col-md-6 p-5 align-self-center">
                      
                                <h5 class="font-weight-normal mb-2">Agrement <?= $NameAgrem; ?></h5>
                      
                                <p class="text-muted">Mini description, je ne sais pas a quoi ressemble.</p>
                      
                                <ul class="list-unstyled font-small mb-0">
                                  <li>
                                    <p class="text-uppercase mb-1"><strong>Note</strong></p>
                                    <p class="text-muted mb-4"><?= !empty($resApprovals) ? $resApprovals[0]['MOYENNE'] : 'Aucune';?> / 20</p>
                                  </li>
                      
                                  <li>
                                    <p class="text-uppercase mb-1"><strong>Commentaire</strong></p>
                                    <p class="text-muted mb-4">
									<?= !empty($resApprovals) ? 'Commentaire de l\'évaluateur : '.$resApprovals[0]['CREER_PAR'] . ', ' . $resApprovals[0]['COMMENTAIRE'] : 'Aucun Commentaire, aucune évaluation n\'a encore été éffectué pour cet Agrement.'; ?></p>
                                  </li>
                      
                                  <li>
                                    <p class="text-uppercase mb-1"><strong>Reclamations</strong></p>
                                    <p class="text-muted mb-4">
										<?= !empty($resApprovals) ? 'Poster ou suivre les sujets du Forum Agrement' : 'Patienté'; ?>, Contacter l'acheteur en charge</p>
                                  </li>                      
                                  <li>
                                    <a class="btn bg-color-primary">ACTUALISER</a>
                                  </li>
                      
                                </ul>
                      
                              </div>
                      
                            </div>
                      
						  </div>
						  <?php else: ?>
							<div class="Pricing-block">
								<div class="pricing-item">
									<div class="pricing-header">
										<h3>Résultat de l'évaluation : Agrément</h3>
									</div>
									<div class="pricing-bottom">
										<p>Veuillez sélectionner un agrément.</p>
									</div>
								</div>
							</div>
						<?php endif; ?>
                      
                        </section>
                      
                      </div>
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
		<h5>Resultat des Agrements</h5>
		<p class="color-grey">
			Vous pouvez voir ici les resultats de tout vos agrements.
			<br>
			Pour cela Il vous suffit de cliquer sur l'agrement que vous voulez voir les resultats
			<br>
      Si vous n'avez postuler à aucun agrement et bien c'est le moment de le faire.
      <br>
      Vous en Pensez Quoi ? 
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