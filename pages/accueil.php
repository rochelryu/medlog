<?php
// Hydrating and check this Supplier information in Data Base
$isNewUser = false;
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
if (!empty($auth['user'])) {
	$verif_data = array(
		'champs' => domaine.".ID_DOM_A, DENOMINATION,PAYS_SIEGE,VILLE, SITUATION_GEO",
		'table' => info_demandeur.','.domaine.','.demandeur,
		'where' => demandeur.".ID_DOM_A = ".domaine.".ID_DOM_A 
				   AND ".demandeur.".ID_CMPT = ".info_demandeur.".ID_CMPT 
				   AND ".demandeur.".ID_CMPT = :comp 
				   AND ".demandeur.".MODE = :mode",
		'tri' => "ORDER BY ".demandeur.".ID_CMPT ASC"
	);
	$verif_bind = array(':comp' =>$auth['user'],':mode' => $mode);
	$checking = array($verif_data, $verif_bind);
	// Get return object in $fetchDatas
	
	$fetchSupplier = $supplier->information($checking);
	foreach ($fetchSupplier as $datas){
		$idDom = $datas[0];
		$denomination = $datas[1];
		$pays = $datas[2];
		$ville = $datas[3];
		$sitGeo = $datas[4];
	}
	unset($verif_bind, $verif_data, $datas,$checking);
}
// Hydrating and check this Supplier information in Data Base

$verif_data = array(
	'champs' => "o.ID_APPEL, o.REF, o.LIBELLE, o.CREER_PAR, o.CREER_LE, o.DATE_D, o.DATE_F, d.LIBELLE DOM_A",
	'table' => offre.' o INNER JOIN '.domaine.' d ON d.ID_DOM_A = o.ID_DOM_A',
	'where' => "d.MODE = :mode AND o.MODE = :mode",
	'tri' => "ORDER BY ID_APPEL DESC LIMIT 10");
$verif_bind = array(':mode' => $mode);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchCallOffer = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);

$verif_data = array(
	'champs' => "id",
	'table' => new_entries,
	'where' => "id_compt = :id_compt AND section = :section",
	'tri' => "ORDER BY id ASC LIMIT 10");
$verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Accueil',);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchNewEntrie = $manager->listAgrement($checking);
if (empty($fetchNewEntrie)) {
	$isNewUser = true;
	$req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
                            $req->bindValue(1,$auth['user'],PDO::PARAM_INT);
                            $req->bindValue(2,'Accueil' ,PDO::PARAM_STR);
                            $req->execute();
                            $req->closeCursor();
}
unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);


$verif_data = array(
	'champs' => "a.ID_AGR, a.LIBELLE, a.DATE_C, a.CREER_PAR, a.CREER_LE, d.LIBELLE DOM_A",
	'table' => agrement.' a INNER JOIN '.domaine.' d ON d.ID_DOM_A = a.ID_DOM_A',
	'where' => "d.MODE = :mode AND a.MODE = :mode",
	'tri' => "ORDER BY ID_AGR DESC LIMIT 10");
//AND ".domaine.".ID_DOM_A = :dom ':dom' => $idDom,
$verif_bind = array(':mode' => $mode);
$checking = array($verif_data, $verif_bind);
// Get return object in $fetchDatas
$fetchApproval = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);
?>
			<div class="col-md-12 col-sm-12 p-5">
              <div class="row">
                <div class="col-md-6">
                  <div class="card text-white bg-color-primary mb-3 card-presentation" >
                    <div class="card-header"><i class="fas fa-2x fa-file-signature"></i> participer à vos appels d'offres et agréments</div>
                    <div class="card-body">
                      <p class="card-text text-white">La solution complètes pour consulter vos marchés</p>
					  <?php if (empty($auth)): ?>
                      <a href="?p=inscription" class="btn btn-rounded waves-effect"><i class="fas fa-sign"></i> S'inscrire</a>
					  <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card text-white bg-color-primary mb-3 card-presentation" >
                    <div class="card-header"><i class="fas fa-2x fa-chart-pie"></i> consulter</div>
                    <div class="card-body">
                      <p class="card-text text-white">Plus de 400 000 avis de marchés, saisissez toutes les opportunités de croissance</p>
                      <div class="row">
                        <form id="recherche_avis" name="recherche_avis" action='./' method="get" class="consulter">
							<input type="hidden" name='p' value='accueil-result' />
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-9 col-sm-9">
                                  <select class="better-dropdown-example" id="id_ref_domaine_activite" name="id_ref_domaine_activite">
                                    <!-- ne pas retirer la ligne sous-dessous -->
                                    <option value="">--choose a ship--</option>
                                    <!-- ici vous pouvez mettre les options -->
									<?php
                                                        // Set level for listing
                                                        $select = "";
                                                        $getting->derouler($nivo = 'two',$select);
                                                        //
                                                        ?>
								  </select>
								  <div class="clear-both"></div>
								<p class="errorMessage" id="errorMessage_id_vp_ref_type_batiment[]"></p>
                                </div>
                                <div class="col-md-2 col-sm-2 pt-3">
                                  <button type="submit" class="btn btn-sm m-0 btn-rounded waves-effect"> <i class="fas fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="row mb-5">
			  <?php if (empty($auth)): ?>
				<div class="container py-5">


					<!--Section: Content-->
					<section class="px-md-5 mx-md-5 text-center dark-grey-text">

					<!--Grid row-->
					<div class="row d-flex justify-content-center">

						<!--Grid column-->
						<div class="col-xl-6 col-md-8">

						<h3 class="font-weight-bold mb-3">Objectifs</h3>

						</div>
						<!--Grid column-->

					</div>


					</section>
					<!--Section: Content-->


					</div>
				<div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="flexbox flex-space-between border-bottom">
                        <p class="border-left-grif-primary pl-2">LES DERNIERS AGRÉMENTS </p>
                        <a href="#"> Tous les agréments <i class="fas fa-plus-circle color-primary"></i></a>
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="row pt-4">
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
								<p>
									De Type <?= $approval['DOM_A']; ?>
									<br>
									Date de cloture : <?= $approval['DATE_C']; ?>
								</p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
                      </div>
                    </div>
                	</div>
                  
                </div>
				<?php else : ?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
							<div class="flexbox flex-space-between border-bottom">
								<p class="border-left-grif-primary pl-2">LES DERNIERS APPELS D'OFFRES </p>
								<a href="#"> Tous les appels offres <i class="fas fa-plus-circle color-primary"></i></a>
							</div>
							</div>
							<div class="col-md-12 ">
							<div class="row pt-4">
							<?php foreach($fetchCallOffer as $callOffer): ?>
								<div class="col-md-12">

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
													<span class='text-small'>Type : <?= $callOffer['DOM_A']; ?> </span>
													<br>
													<span class='text-small'>Libellé : <?= $callOffer['LIBELLE']; ?> </span>
													<br>
													<span class='text-small'>Début : <?= $callOffer['DATE_D']; ?> & Fin : <?= $callOffer['DATE_F']; ?> </span>
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
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="flexbox flex-space-between border-bottom">
									<p class="border-left-grif-primary pl-2">LES DERNIERS AGRÉMENTS </p>
									<a href="#"> Tous les agréments <i class="fas fa-plus-circle color-primary"></i></a>
								</div>
							</div>
							<div class="col-md-12 ">
								<div class="row pt-4">
									<?php foreach($fetchApproval as $approval): ?>
										
										<div class="col-md-12">
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
												<p>
													De Type <?= $approval['DOM_A']; ?>
													<br>
													Date de cloture : <?= $approval['DATE_C']; ?>
												</p>
												</div>
											</div>
										</div>
										
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
              </div>
			</div>
<?php if ($isNewUser): ?>
<div class="modal show active  fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-right" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color-primary w-100" id="myModalLabel">GUIDE</h4>
      </div>
      <div class="modal-body">
		<h5>Agrements</h5>
		<p class="color-grey">Un agrement consiste a prendre ce qui est de plus naturel. <br> tout comptes crée peut postuler a un agrement</p>
		<h5>Appels d'offre</h5>
		<p class="color-grey">Un appel d'offre consiste a repondre a un fournisseur qui m'a choisie pour la prestation de mes services. <br> Attention tout comptes n'est autoriser a postuler a un appels d'offres uniquement quand le fournisseur est approuvé ce derniers</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm back-guide">OK</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>