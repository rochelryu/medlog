<?php
// Hydrating and check this Approval informations in Data Base
$verif_data = array(
	'champs' => "a.ID_AGR, a.LIBELLE,a.CREER_PAR, a.CREER_LE, a.DATE_C, d.LIBELLE DOM_A",
	'table' => agrement.' a INNER JOIN '.domaine.' d ON d.ID_DOM_A = a.ID_DOM_A',
	'where' => "d.MODE = :mode AND a.MODE = :mode",
	'tri' => "ORDER BY ID_AGR DESC");
$verif_bind = array(':mode' => $mode);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchApproval = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);
?>

<div class="col-md-12 mb-5">
	<div class="row">
		<div class="col-md-12 mt-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Accueil</a></li>
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Agréments</a></li>
				<li class="breadcrumb-item active" class="h5 color-primary">Participer à un agrément</li>
			</ol>
		</nav>
		</div>
		<div class="col-md-12 mt-3">
			<div class="row">
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
								<p>De Type <?= $approval['DOM_A']; ?> <br>Date de cloture : <?= $approval['DATE_C']; ?></p>

								</div>
							</div>
						</div>
						<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>