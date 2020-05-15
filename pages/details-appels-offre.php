<?php
// Hydrating and check this Call Offer informations in Data Base
$isSkiped = true;
$isNewUser = false;
$compteIncomplet = false;
if (!empty($auth)) {
    $id = isset($_GET['id']) && !empty($_GET['id']) ? (int)htmlspecialchars($_GET['id']) : null;

    $verif_data = array(
    'champs' => "o.ID_APPEL, o.REF, o.LIBELLE, o.DATE_D, o.DATE_F, d.LIBELLE DOM_A",
    'table' => offre.' o INNER JOIN '.domaine.' d ON d.ID_DOM_A = o.ID_DOM_A',
    'where' => "o.ID_APPEL = :id AND d.MODE = :mode AND o.MODE = :mode",
    'tri' => "ORDER BY ID_APPEL DESC");
    $verif_bind = array(':id' => $id, ':mode' => $mode);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $callOffer = $manager->listAgrement($checking)[0];
	unset($verif_bind, $verif_data, $checking);
	
	$verif_data = array(
		'champs' => "ID_AGRE",
		'table' => agrees,
		'where' => "ID_CMPT = :comp AND ID_AGR = :id AND MODE = :mode",
		'tri' => "ORDER BY ID_AGRE ASC"
	);
		$verif_bind = array(':comp' =>$auth['user'], ':id' =>$id,':mode' => $mode);
		$checking = array($verif_data, $verif_bind);
		$agree = $supplier->recupAgree($checking);
		unset($verif_data, $verif_bind, $checking);
	
		$verif_data = array(
			'champs' => "id",
			'table' => new_entries,
			'where' => "id_compt = :id_compt AND section = :section",
			'tri' => "ORDER BY id ASC LIMIT 10");
		$verif_bind = array(':id_compt' => $auth['user'], ':section' => 'Postuler appels offres',);
		$checking = array($verif_data, $verif_bind);
		// Get return object in $fetchDatas
		$fetchNewEntrie = $manager->listAgrement($checking);
		if (empty($fetchNewEntrie)) {
			$isNewUser = true;
			$req = $bdd->prepare("INSERT INTO ". new_entries . "(id_compt, section) VALUES (?,?)");
									$req->bindValue(1,$auth['user'],PDO::PARAM_INT);
									$req->bindValue(2,'Postuler appels offres' ,PDO::PARAM_STR);
									$req->execute();
									$req->closeCursor();
		}
		unset($verif_bind, $fetchNewEntrie, $req, $verif_data, $checking);
	
	$dates = explode('/', $callOffer['DATE_F']);
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


	$verif_data = array(
        'champs' => "*",
        'table' => info_contact_four,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_CNT_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas

    $res = $manager->listAgrement($checking);
    if (empty($res)) {
        $contact_four = array();
    } else {
        $contact_four = $res;
    }
    
    unset($verif_bind,$res, $verif_data, $checking);

    $verif_data = array(
        'champs' => "*",
        'table' => info_ca_four,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_CA_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas

    $res = $manager->listAgrement($checking);
    if (empty($res)) {
        $chiffre_four = array();
    } else {
        $chiffre_four = $res;
    }
    
    unset($verif_bind,$res, $verif_data, $checking);

    $verif_data = array(
        'champs' => "*",
        'table' => info_rh_four,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_RH_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);
    // Get return object in $fetchDatas
    $res = $manager->listAgrement($checking);
    if (empty($res)) {
        $ressource_humaine = array();
    } else {
        $ressource_humaine = $res[0];
    }
    
    unset($verif_bind,$res, $verif_data, $checking);

    $verif_data = array(
        'champs' => "*",
        'table' => info_pc_four,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_PC_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);

    $res = $manager->listAgrement($checking);
    if (empty($res)) {
        $position_commercial = array();
    } else {
        $position_commercial = $res[0];
    }
    
    unset($verif_bind,$res, $verif_data, $checking);


    $verif_data = array(
        'champs' => "*",
        'table' => info_demandeur,
        'where' => "ID_CMPT = :id AND MODE = :mode",
        'tri' => "ORDER BY ID_IDT_FRS ASC");
    $verif_bind = array(':id' => $auth['user'], ':mode' => 1);
    $checking = array($verif_data, $verif_bind);

    $res = $manager->listAgrement($checking);
    if (empty($res)) {
        $information = array();
    } else {
        $information = $res[0];
    }
    
	unset($verif_bind,$res, $verif_data, $checking);
	
	if(empty($information) OR empty($contact_four) OR empty($chiffre_four) OR empty($ressource_humaine) OR empty($position_commercial)) {
		$isSkiped = true;
		$compteIncomplet = true;
	}
}
?>
<?php if (!empty($auth) && $agree != 0): ?>

<div class="col-md-12 col-sm-12 p-5 half-heigth">
              <div class="row">
                <div class="flexbox allwidth flex-center">
				<div class="row mb-5 p-5 d-flex flex-center">
				<div class="col-lg-4 col-md-4">
											<img src="./assets/pictures/offre.svg" class="img-fluid"
												alt="Sample project image" />
                                      </div>
                                        <div class="col-md-6 col-lg-6">
											<div class="card">
												<div class="card-header">
													<h4 class="color-primary"><?= $callOffer['REF']; ?></h4>
												</div>
												<div class="card-body">
													<blockquote class="blockquote mb-0">
													<p><?= $callOffer['LIBELLE']; ?></p>
													<footer class="blockquote-footer">Date Début : <b><?= $callOffer['DATE_D']; ?></b></footer>
													<footer class="blockquote-footer">Date Fin : <b><?= $callOffer['DATE_F']; ?></b></footer>
													</blockquote>
													<input type="hidden" name="id_calloffer" id="idCalloffer" value="<?= $callOffer['ID_APPEL']; ?>">
													<input type="hidden" name="id_user" id="idUser" value="<?= $agree; ?>">
													<?php if (!$isSkiped): ?>
														<button class="btn bg-color-primary waves-effect" id="postCalloffer">POSTULER</button>
													<?php endif; ?>
												</div>
												<div class="card-footer">
													<div class="flexbox flex-space-between">
													<p><i class="fas fa-map-marker-alt"></i> <?= $callOffer['DOM_A']; ?></p>
													<p><i class="fas fa-thumbtack"></i> <?= $callOffer['DOM_A']; ?></p>
													</div>
												</div>
											</div>
										</div>
                                        
                </div>
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
		<h5>Postuler Appels d'offre</h5>
		<p class="color-grey">
			Il est possible de postuler a un appels uniquement lorsqu'on est autorisé et que la date de fin ne soit pas encore depassée
			<br>
			Une fois un Appel d'offre postuler, il vous faudra mettre a jour cet appel d'offres afin de terminer votre demande de postulation.
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm back-guide">OK</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if ($compteIncomplet): ?>
<div class="modal show active  fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-left" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color-primary w-100" id="myModalLabel">COMPTE INCOMPLET</h4>
      </div>
      <div class="modal-body">
		<h5>Pour Pouvoir Postuler à un Appel d'offre</h5>
		<p class="color-grey">
			Il faut que vous aillez remplie encore plus d'informations que celles donné à l'inscription (Informations Generale, Ressource Humaine, Position Commerciale, Chiffres d'Affaire et Contacts).<br>
			Pour le faire maintenant 
			<a href="?p=profil-information" class="btn bg-color-primary">CLIQUEZ ICI</a>
		</p>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>
			
