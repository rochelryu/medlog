<?php
ini_set('default_charset', 'utf-8');
setlocale (LC_TIME, 'fr_FR.utf8','fra');
require_once('functions/pdo_connect.php');
require_once('define/define.php');
require_once('functions/function.traitement.php');
require_once('functions/encode_utf8.php');
require_once('functions/extension.php');
require_once('callback.php');
if (!isset($_SESSION)) {
	session_start();
}
$supplier = new Fourniss($bdd);
$manager = new Manager($bdd);
$idFour = 0;
$username = "";
$login_string = "";
$idDom = 0;
$denomination = "";
$pays = "";
$ville = "";
$sitGeo = "";
$mode = 1;
$querie = '';
$title = '';

if($supplier->Veriflogin(demandeur) == true){
	$idFour = $_SESSION['user_id'];
	$username = str_replace ('deg', '°', $_SESSION['username']);
	$login_string = $_SESSION['login_string'];
}
if (isset($_GET['p']) && !empty($_GET['p']) && file_exists('pages/' . $_GET['p'] . '.php')) {
	$page = 'pages/' . $_GET['p'] . '.php';
	$querie = $_GET['p'].'.css';
  $title = strtoupper($_GET['p']);
} else if (isset($_GET['d']) && !empty($_GET['d']) && file_exists('assets/files/' . $_GET['d'])) {
  $document = $_GET['d'];
  $page = 'assets/files/' . $document;
  header("Content-Type: application/octet-stream");
  header("Content-Transfer-Encoding: Binary");
  header("Content-disposition: attachment; filename=\"$document\""); 
  echo readfile($page);
}

else {
  if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['login_string'])) {
    $page = 'pages/accueil.php';
      $querie = 'accueil.css';
      $title = 'ACCUEIL';
    
  }
    else {
      $page = 'pages/without_auth.php';
    $querie = 'without_auth.css';
    $title = 'ACCUEIL';
    }
}

$auth = [];

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['login_string'])) {
	$auth = [
		'user' => (int) $_SESSION['user_id'],
		'name' => (string) $_SESSION['username'],
		'login' => (string) $_SESSION['login_string'],
  ];
  $verif_data = array(
    'champs' => demandeur.".ID_DOM_A, DENOMINATION,PAYS_SIEGE,VILLE, SITUATION_GEO",
    'table' => info_demandeur.','.domaine.','.demandeur,
    'where' => demandeur.".ID_DOM_A = ".domaine.".ID_DOM_A 
                 AND ".demandeur.".ID_CMPT = ".info_demandeur.".ID_CMPT 
                 AND ".demandeur.".ID_CMPT = :comp 
                 AND ".demandeur.".MODE = :mode",
    'tri' => "ORDER BY ".demandeur.".ID_CMPT ASC"
  );
  $verif_bind = array(':comp' => $auth['user'],':mode' => $mode);
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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <!-- implement font-awesome for icon svg -->
    <link rel="stylesheet" href="assets/css/all.css">

    <!-- implement boostrap minimal style  -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/animate.css">

    <!-- implement material design style  -->
  <link rel="stylesheet" href="assets/css/mdb.css">
  
  <!-- implement material design style  -->
	<link rel="stylesheet" href="assets/css/stepper.css">
	
	<!-- implement toast style  -->
    <link rel="stylesheet" href="assets/css/jquery.notify.min.css">

    <!-- implement select style -->
    <link rel="stylesheet" href="assets/css/jquery.betterdropdown.css">

	<?php if (strpos($querie, 'profil') !== false): ?>
    <!-- implement style for home page -->
    <link rel="stylesheet" href="assets/css/profil.css">

	<?php else : ?>

    <link rel="stylesheet" href="assets/css/<?= $querie; ?>">
	<?php endif; ?>
    <!-- implement common style for all page -->
    <link rel="stylesheet" href="assets/css/common.css">

    <link rel="stylesheet" href="assets/css/bootstrapTable.css">

    <!-- implement jquery script -->
    <script src="assets/js/jquery.js"></script>

    <script src="assets/js/bootstrapTable.js"></script>
    <title><?= $title; ?></title>
    <script>function hosting() {
      document.write(location.pathname)
    }
    </script>
</head>
<body>
	<?php if (strpos($querie, 'profil') !== false && !empty($auth)): ?>
	<div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
          <div class="sidebar-content">
            <div class="sidebar-brand">
              <a onClick="location.href = location.origin + location.pathname;">Accueil</a>
              <div id="close-sidebar">
                <i class="fas fa-times"></i>
              </div>
            </div>
            <div class="sidebar-header">
              <div class="user-pic">
                <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                  alt="User picture">
              </div>
              <div class="user-info">
                <span class="user-name">
                  <strong><?= str_replace ('deg', '°', $auth['name']); ?></strong>
                </span>
                <span class="user-role">Fournisseur</span>
                <span class="user-status">
                  <i class="fa fa-circle color-success"></i>
                  <span>En ligne</span>
                </span>
              </div>
            </div>
            
            <div class="sidebar-menu">
              <ul>
                <li class="header-menu">
                  <span>Mes Resultats</span>
                </li>
                <li class="sidebar-dropdown">
                  <a href="?p=res-agrements">
                    <i class="fas fa-file-signature"></i>
                    <span>Agrement</span>
                    
                  </a>
                </li>
                <li class="sidebar-dropdown">
                  <a href="?p=res-appels-offre">
                    <i class="fa fa-chart-line"></i>
                    <span>Appel d'offre</span>
                  </a>
                  
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Autres</span>
                  </a>
                  
                </li>
                <li class="header-menu">
                  <span>Extra</span>
                </li>
                <li>
                  <a href="?p=profil-information">
                    <i class="fas fa-user"></i>
                    <span>Mes informations</span>
                  </a>
                </li>
                <li>
                  <a href="?p=profil-reglages">
                    <i class="fas fa-cog"></i>
                    <span>Réglage</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- sidebar-menu  -->
          </div>
          <!-- sidebar-content  -->
          <div class="sidebar-footer">
            <a href="/">
             &copy; <script>document.write(new Date().getFullYear().toString())</script> MEDLOG
            </a>
            <a href="#">
              <i class="fa fa-power-off"></i>
            </a>
          </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
          <?php include $page; ?>
        </main>
        <!-- page-content" -->
    </div>
	<?php else : ?>
		<?php if (strpos($querie, 'inscription') !== false && empty($auth)): ?>
			<?php include $page; ?>
		<?php else : ?>
			<div class="container-fluid">
				<div class="row">
				<?php include './include/header.php'; ?>
				<?php include $page; ?>
				</div>
			</div>
			<div class="modal fade bottom" id="frameModalBottom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
				<div class="modal-dialog modal-frame modal-bottom" role="document">


					<div class="modal-content">
					<div class="modal-body">
						<div class="row d-flex justify-content-center align-items-center">

						<p class="pt-3 pr-2">Pour voir des agrement et des appels d'offre veuillez vous authentifier</p>

						<a href="?p=inscription" class="btn btn-secondary">S'inscrire</a>
						</div>
					</div>
					</div>
				</div>
			</div>

			<section class="container-fluid footer navbar-dark">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-6">
          <h6>FAQ</h6>
          <ul>
            <li><a href="#">Nos sources</a></li>
            <li><a href="#">Nos supports de publication</a></li>
          </ul>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 border-left">
          <h6>Contacter</h6>
          <ul>
            <li><a href="#">Vous souhaitez rechercher un avis</a></li>
            <li><a href="#">Vous souhaitez publier un avis</a></li>
            <li><a href="#">Nous contacter</a></li>
          </ul>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 border-left">
          <h6>Informations légales</h6>
          <ul>
            <li><a href="#">Conditions générales d’utilisation</a></li>
            <li><a href="#">Mentions légales</a></li>
          </ul>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 border-left">
          <h6>La grande adresse des appels d’offres</h6>
          <ul class="ul-share">
            <li><a href="#"><i class="fab fa-facebook icon-link icon-fb"></i></a></li>
            <li><a href="#"><i class="fab fa-google-plus icon-link icon-gl"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter icon-link icon-tw"></i></a></li>
          </ul>
          </div>
        </div>
			</section>
		<?php endif; ?>
	<?php endif; ?>

    <!-- implement font-awesome script -->
    <script src="assets/js/all.js"></script>

    <!-- implement popper script -->
    <script src="assets/js/popper.js"></script>

    <!-- implement bootsrap script -->
    <script src="assets/js/bootstrap.js"></script>

    <!-- implement material design script -->
    <script src="assets/js/mdb.js"></script>

    <!-- implement stepper script -->
   <script src="assets/js/stepper.js"></script>
  	
	    <!-- implement toast script -->
    <script src="assets/js/jquery.notify.min.js"></script>

    

    <script type="text/javascript" src="assets/js/jquery.waypoints.js"></script>
	
	<!-- ajax querie -->
	<script src="assets/js/main.js"></script>

  <?php if (strpos($querie, 'inscription') !== false): ?>
    <!-- implement inscription page script -->
    <script src="assets/js/inscription.js"></script>
	<?php endif; ?>

  <!-- implement select autocomplete script -->
  <script src="assets/js/jquery.betterdropdown.js"></script>

  <!-- implement accueil page script -->
  <script src="assets/js/accueil.js"></script>

  <?php if (strpos($querie, 'accueil') !== false): ?>
    <script>
    $(document).ready(function() {
      $('#id_ref_domaine_activite').betterDropdown({
          itemName: "Domaine d'activite",
          displayTextBelow: true
      });
    })
    </script>
  <?php endif; ?>

  <?php if (strpos($querie, 'without') !== false): ?>
    <!-- implement accueil page script -->
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/plugins.js"></script>
  <?php endif; ?>
  
</body>
</html>
