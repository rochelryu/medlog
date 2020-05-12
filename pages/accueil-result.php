<?php
// Hydrating and check this Approval informations in Data Base
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
}
$id = 0;
if (isset($_GET['id_ref_domaine_activite']) && !empty($_GET['id_ref_domaine_activite'])) {
	$id = (int) htmlspecialchars($_GET['id_ref_domaine_activite']);
  $verif_data = array(
    'champs' => "a.ID_AGR, a.LIBELLE,a.CREER_PAR, a.CREER_LE, a.DATE_C, d.LIBELLE DOM_A",
    'table' => agrement.' a INNER JOIN '.domaine.' d ON d.ID_DOM_A = a.ID_DOM_A',
    'where' => "d.MODE = :mode AND a.MODE = :mode AND d.ID_DOM_A = :dom",
    'tri' => "ORDER BY ID_AGR DESC");
  $verif_bind = array(':mode' => $mode, ':dom' => $id);
  $checking = array($verif_data, $verif_bind);
  // Get return object in $fetchDatas
  $fetchApproval = $manager->listAgrement($checking);
	unset($verif_bind, $verif_data, $checking);
}
?>
<?php if (!empty($auth)): ?>
  <div class="col-md-12 mb-5">
	<div class="row">
		<div class="col-md-12 mt-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Accueil</a></li>
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Agréments</a></li>
				<li class="breadcrumb-item active" class="h5 color-primary">Resultat des recherches d'agrément</li>
			</ol>
		</nav>
		</div>
		<div class="col-md-12 mt-3">
			<div class="row">
      <?php if (empty($fetchApproval)): ?>
                      <div class="col-md-12">
                        <div class="flexbox flex-center">
                          <img src="assets/pictures/nodata.svg" alt="nodata" class='img-fluid'>
                          <h4>Aucun resultat de correspondance avec cette categorie</h4>
                        </div>
                      </div>
					  <?php endif; ?>
			<?php foreach($fetchApproval as $approval): ?>
				<div class="col-md-6">
						  	<div class="blog-card alt">
								<div class="meta">
								<div class="photo" style="background-image: url(./assets/pictures/agrement.svg)"></div>
								<ul class="details">
									<li class="author"><a href="#">De <?= $approval['CREER_PAR']; ?></a></li>
									<li class="date"><a href="#">Le <?= $approval['CREER_LE']; ?></a></li>
								</ul>
								</div>
								<div class="description">
								<h1 class="color-primary"><a <?= !empty($auth) ? 'href="?p=details-agrements&id='. $approval['ID_AGR'] .'"' : 'type="button" data-toggle="modal" data-target="#frameModalBottom"' ?>><?= $approval['LIBELLE']; ?></a></h1>
								<h2>Agrement</h2>
								<p>De Type <?= $approval['DOM_A']; ?> <br>Date de cloture est prevu pour le <?= $approval['DATE_C']; ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
			<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>