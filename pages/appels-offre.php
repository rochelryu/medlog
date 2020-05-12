<?php
// Hydrating and check this Call Offer informations in Data Base

$verif_data = array(
	'champs' => "o.ID_APPEL, o.REF, o.LIBELLE, o.CREER_PAR, o.CREER_LE, o.DATE_D, o.DATE_F, d.LIBELLE DOM_A",
	'table' => offre.' o INNER JOIN '.domaine.' d ON d.ID_DOM_A = o.ID_DOM_A',
	'where' => "d.MODE = :mode AND o.MODE = :mode",
	'tri' => "ORDER BY ID_APPEL DESC");
$verif_bind = array(':mode' => $mode);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchCallOffer = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);
?>
<?php if (!empty($auth)): ?>
<div class="col-md-12 mb-5">
	<div class="row">
		<div class="col-md-12 mt-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Accueil</a></li>
				<li class="breadcrumb-item"><a href="/" class="h5 color-primary">Appels d'offres</a></li>
				<li class="breadcrumb-item active" class="h5 color-primary">Participer à un Appels d'offres</li>
			</ol>
		</nav>
		</div>
		<div class="col-md-12 mt-3">
			<div class="row">
			<?php foreach($fetchCallOffer as $callOffer): ?>
				<div class="col-md-6">
											<div class="blog-card">
												<div class="meta">
												<div class="photo" style="background-image: url(./assets/pictures/offre.svg)"></div>
												<ul class="details">
													<li class="author"><a href="#">De <?= $callOffer['CREER_PAR']; ?></a></li>
													<li class="date"><a href="#">Le <?= $callOffer['CREER_LE']; ?></a></li>
												</ul>
												</div>
												<div class="description">
												<h1 class="color-primary"><a <?= !empty($auth) ? 'href="?p=details-appels-offre&id='. $callOffer['ID_APPEL'] .'"' : 'type="button" data-toggle="modal" data-target="#frameModalBottom"' ?>><?= $callOffer['REF']; ?></a></h1>
												<h2>Appel d'Offre</h2>
												<p><blockquote class="blockquote mb-0">
													<span class='text-small'>TYPE : <?= $callOffer['DOM_A']; ?> </span> <br>
													<span class='text-small'>DÉBUT : <?= $callOffer['DATE_D']; ?> & FIN : <?= $callOffer['DATE_F']; ?> </span>
												</blockquote>
												</p>
												
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