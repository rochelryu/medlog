<?php
ini_set('default_charset', 'utf-8');
setlocale (LC_TIME, 'fr_FR.utf8','fra');
require_once('../functions/pdo_connect.php');
require_once('../define/define.php');
require_once('../functions/function.traitement.php');
require_once('../functions/encode_utf8.php');
require_once('../functions/extension.php');
require_once('../callback.php');
if (!isset($_SESSION)) {
	sec_session_start();
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
if($supplier->Veriflogin(demandeur) == true){
	$idFour = $_SESSION['user_id'];
	$username = str_replace ('deg', '°', $_SESSION['username']);
	$login_string = $_SESSION['login_string'];
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout'] == hash('sha512', "true" . $_SERVER['HTTP_USER_AGENT']))){
	$supplier->deconnexion();

	unset($supplier, $idFour, $username, $login_string);
}
if(empty($login_string) || empty($username) || empty($idFour)){
	echo '<script> document.location.href= "http://'.$_SERVER["HTTP_HOST"].'/";</script>';
	unset($supplier, $idFour, $username, $login_string);
	exit;
}
// Hydrating and check this Supplier information in Data Base

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
unset($verif_bind, $verif_data, $datas, $fetchSupplier,$checking);
// Hydrating and check this Supplier information in Data Base

$verif_data = array(
	'champs' => "ID_AGR, ".domaine.".LIBELLE, ".agrement.".LIBELLE, DATE_C",
	'table' => agrement.','.domaine,
	'where' => agrement.".ID_DOM_A = ".domaine.".ID_DOM_A 
			   AND ".domaine.".MODE = :mode AND ".agrement.".MODE = :mode",
	'tri' => "ORDER BY ID_AGR DESC LIMIT 4");
//AND ".domaine.".ID_DOM_A = :dom ':dom' => $idDom,
$verif_bind = array(':mode' => $mode);
$checking = array($verif_data, $verif_bind);

// Get return object in $fetchDatas

$fetchApproval = $manager->listAgrement($checking);
unset($verif_bind, $verif_data, $checking);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10"><![endif]-->
	<meta name="description" content="Portail Fournisseur de Gestion des Agrements et Appel d'Offre">
	<meta name="author" content="Junior MAMADOU : s_co_2007@hotmail.fr">
	<link rel="shortcut icon" href="style/images/favicon.png">
	<title>IvoirusBuyer : Portail Fournisseur</title>
	<!-- Bootstrap core CSS -->
	<link href="style/css/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="style/js/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
    //<!-- 
        document.oncontextmenu = new Function("return false");
    //-->
    window.onload=function(){
document.onkeydown=function(e){var evt=e?e:window.event,key=e.which?e.which:e.keyCode;
      if (key == 123 && e.preventDefault) e.preventDefault();
      //if (window.console) console.log('key: '+key);
      // Installation d'un switch
            switch(key){
			   case 123 :
			   event.keyCode = 0; 
			   event.returnValue = false; 
			   event.cancelBubble = true; 
			   return false;
			break;
               default :
                  // la suite...
           }// Fin du switch
}
};
</script>
</head>
<body>

<!-- Start Loading -->

<section class="loading-overlay">
    <div class="Loading-Page">
		<h2 class="loader">Loading...</h2>
    </div>
</section>

 <!-- End Loading  -->

<!-- Start Sidebar  -->

<div class="menu-wrap">
    <nav class="menu">
		<div class="news-area side-nav-block">
            <div class="title-sidebar">
                <h2>Bienvenue <?php echo $username;?></h2>
            </div>
			<ul class="news-footer">
				<li>
					<a href="?doLogout=<?php echo hash('sha512', "true" . $_SERVER['HTTP_USER_AGENT']);?>">
						<img src="style/images/page/logout.png" alt="">
					<h6><a href="?doLogout=<?php echo hash('sha512', "true" . $_SERVER['HTTP_USER_AGENT']);?>">Déconnexion</a></h6>
					<span class="news-date">le : <a href="#"><?php echo (strftime("%A %d %B %Y")); ?></a></span></a>
				</li>
			</ul>
		</div>
    </nav>
    <button class="close-button" id="close-button">Close Menu</button>
</div>


<!-- End Sidebar  -->

<div class="content-wrap">
	<div id="home" class="body-wrapper">
	
		<!-- Start Section Header style1 -->
		
		<header id="header" class="header-style1">
			<div id="header-main">
				<!-- Start Section Top Header -->
				<div class="top-header">
					<div class="container">
						<div class="row">
							<div class="contact-text float-right">
								<ul>
									<li><span>Téléphone : </span> +(225) 000 00 000</li>
									<span class="sep">|</span>
									<li><span>Email : </span> portail-frs@Ivoiruss.com</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- End Section Top Header -->
				
				<!-- Start Section Bottom Header -->
				<div class="bottom-header">
					<div class="Navbar-Header navbar basic" data-sticky="true">
						<div class="container">
							<div class="row">
								<div class="container-header">
									<div class="Logo-Header float-left">
										<a class="navbar-logo" href="./"><img src="style/images/logo/logo-construction.png" alt=""></a>
									</div>
									<div class="header-icon float-right">
										<div class="site-icons-ul float-right">
											<ul class="icons-ul">
												<li class="sidebar-menu"><a href="#" id="open-button"></a></li>
											</ul>
										</div>

									</div>
									<!-- Start Navbar -->
									<div class="navbar-header float-right">
										<div id="cssmenu" class="Menu-Header top-menu">
											<div class="menu-button"></div>
											<ul class="flexnav one-page" data-breakpoint="992">
											   <li class="has-sub current"><a href="./">Accueil</a></li>
												<li class="has-sub"><a href="#">Agrément RFI</a>
													<ul>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Agrement' . $login_string);?>">Participer</a></li>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Mise à jours Agrement' . $login_string);?>">Mise à Jour</a></li>

													</ul>
												</li>
												<li class="has-sub"><a href="#">Appel d'Offre RFP</a>
													<ul>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Appel' . $login_string);?>">Participer</a></li>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Mise à jours Apel' . $login_string);?>">Mise à Jour</a></li>
													</ul>
												</li>
												<li class="has-sub"><a href="#">Forum</a>
													<ul>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Forums Agrement' . $login_string);?>">Détails Agrements</a></li>
														<li><a href="Menu/?lab=<?php echo hash('sha512', 'Forums Appel' . $login_string);?>">Détails Appel d'Offre</a></li>
													</ul>
												</li>
												<li class="has-sub yamm-fullwidth"><a href="#">Gestions des fichiers</a>
													<ul>
														<li>
															<div class="col-md-3">
																<h5>Contrats</h5>
																<ul>
																	<li><a href="Menu/?lab=<?php echo hash('sha512', 'Contrat : Clause' . $login_string);?>">Clause de confidentialité</a></li>
																	<li><a href="Menu/?lab=<?php echo hash('sha512', 'Contrat : Annexe' . $login_string);?>">Contrat et Annexe</a></li>
																	<li><a href="Menu/?lab=<?php echo hash('sha512', 'Contrat : Avenant' . $login_string);?>">Avenant</a></li>
																</ul>
															</div>
															<div class="col-xs-12 col-sm-6 col-md-3">
																<h5>Documents</h5>
																<ul>
																	<li><a href="Menu/?lab=<?php echo hash('sha512', 'Document : Catalogue' . $login_string);?>">Catalogue</a></li>
																	<li><a href="Menu/?lab=<?php echo hash('sha512', 'Document : Facture' . $login_string);?>">Factures</a></li>
																</ul>
															</div>
														</li>
													</ul>
												</li>
												<li class="has-sub yamm-fullwidth"><a href="#">Mon compte</a>
													<ul>
													  <li>
														<div class="col-md-3">
															<h5>Parametres</h5>
															<ul>
																<li><a href="Menu/?lab=<?php echo hash('sha512', 'Compte : Info' . $login_string);?>">Mes informations</a></li>
																<li><a href="Menu/?lab=<?php echo hash('sha512', 'Compte : Params' . $login_string);?>">Réglages</a></li>
															</ul>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<h5>Mes resultats</h5>
															<ul>
																<li><a href="Menu/?lab=<?php echo hash('sha512', 'Compte : Resultat Agrement' . $login_string);?>">Agrements</a></li>
																<li><a href="Menu/?lab=<?php echo hash('sha512', 'Compte : Resultat Appel' . $login_string);?>">Appel d'Offre</a></li>
																<li><a href="Menu/?lab=<?php echo hash('sha512', 'Compte : Other' . $login_string);?>">Autre</a></li>
															</ul>
														</div>
													  </li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<!-- End Navbar -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Section Bottom Header -->
			</div>	
			
			<!-- Start Revelation Slider -->
			
			<div class="tp-banner-container No-previous">
				<div id="rev_slider"  class="rev_slider fullwidthabanner" data-version="5.0.7">
					<ul>
						<li data-index="rs-10" data-transition="fade" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-description="">
							<!-- MAIN IMAGE -->
							<img alt="" src="style/images/Slider/Slider1.jpg" data-bgposition="center bottom" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="0" class="rev-slidebg" data-no-retina>
							<!-- LAYERS -->

							<!-- LAYER NR. 1 -->
							<div class="tp-caption Photography-Subline   tp-resizeme" 
							id="slide-1-layer-1" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['top','top','top','top']" data-voffset="['220','220','250','220']" 
							data-fontsize="['18','18','18','14']"
							data-lineheight="['30','30','30','18']"
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#FFF;">Bienvenue sur le Portail Fournisseur : <?php echo $denomination;?>
							</div>

							<!-- LAYER NR. 2 -->
							<div class="tp-caption NotGeneric-Title  tp-resizeme rs-parallaxlevel-0" 
							id="slide-1-layer-2" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['top','top','top','top']" data-voffset="['260','260','280','260']" 
							data-fontsize="['55','55','55','22']"
							data-lineheight="['55','55','55','20']"
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="500" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on"
							
							style="z-index: 6; white-space: nowrap;"><i class="fa fa-star-half-full"></i> <span style="z-index: 5; white-space: nowrap; font-size: 55px; line-height: 55px; color:#03529f;">IvoirusBuyer Consulting</span><i class="fa fa-star-half-full"></i>
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption Photography-Subline tp-resizeme" 
							id="slide-1-layer-3" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['50','50','100','110']" 
							data-fontsize="['18','15','18','14']"
							data-lineheight="['30','30','30','26']"
							data-width="['900','800','600','400']"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#FFF; text-align:center;">Nous vous offrons ce Portail interactif afin de faciliter La Participation en ligne aux :  Agréments , Appel d'Offre & Dépôt des documents relatifs.
							</div>

							<!-- LAYER NR. 4 -->
							<a class="tp-caption rev-btn rev-btn  rs-parallaxlevel-0"  href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Agrement' . $login_string);?>"
							id="slide-1-layer-4" 
							data-x="['center','center','center','center']" data-hoffset="['-100','-100','-150','-100']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['130','130','180','190']"
							data-fontsize="['14','14','12','8']"						
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Linear.easeNone;"
							data-style_hover="c:rgba(51, 51, 51, 1.00);bg:rgba(255, 255, 255, 1.00);"
				 
							data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="1750" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on" 
							data-responsive="off"
							
							style="z-index: 14; white-space: nowrap; font-size: 14px; line-height: 40px; text-transform:uppercase; font-weight: 600; color: rgb(255, 255, 255);font-family:Open Sans;background-color:rgb(0, 76, 153);padding:0px 30px 0px 30px;border-color:rgba(0, 0, 0, 1.00);border-width:2px;border-radius:2px;">Agrements
							</a>


							<!-- LAYER NR. 5 -->
							<a class="tp-caption rev-btn rev-btn  rs-parallaxlevel-0"  href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Appel' . $login_string);?>"
							id="slide-1-layer-5" 
							data-x="['center','center','center','center']" data-hoffset="['100','100','150','100']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['130','130','180','190']"
							data-fontsize="['14','14','12','8']"						
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Linear.easeNone;"
							data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgb(0, 76, 153);"
				 
							data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="1750" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on" 
							data-responsive="off"
							
							style="z-index: 14; white-space: nowrap; font-size: 14px; line-height: 40px; text-transform:uppercase; font-weight: 600; color: rgb(0, 0, 0);font-family:Open Sans;background-color:rgb(255, 255, 255);padding:0px 30px 0px 30px;border-color:rgba(0, 0, 0, 1.00);border-width:2px;border-radius:2px;">Consultations
							</a>

						</li>

						<li data-index="rs-11" data-transition="fade" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-description="">
							<!-- MAIN IMAGE -->
							<img alt="" src="style/images/Slider/Slider2.jpg" data-bgposition="center bottom" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
							<!-- LAYERS -->

							<!-- LAYER NR. 1 -->
							<div class="tp-caption caption-icon tp-resizeme" 
							id="slide-2-layer-1" 
							data-x="['center','center','center','center']" data-hoffset="['120','120','120','120']" 
							data-y="['top','top','top','top']" data-voffset="['220','90','220','200']" 
							data-fontsize="['64','64','40','20']"
							data-lineheight="['100','100','100','70']"
							data-width="['100','100','100','70']"
							data-height="['100','100','100','70']"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#03529f;"><span class="icon icon-Column" style="transition: all 0s ease 0s; min-height: 0px; min-width: 0px; line-height: 64px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-size: 64px;"></span>
							</div>
							
							<!-- LAYER NR. 2 -->
							<div class="tp-caption caption-icon tp-resizeme" 
							id="slide-2-layer-2" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['top','top','top','top']" data-voffset="['220','90','220','200']" 
							data-fontsize="['64','64','40','20']"
							data-lineheight="['100','100','100','70']"
							data-width="['100','100','100','70']"
							data-height="['100','100','100','70']"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#03529f;"><span class="icon icon-DiamondRing" style="transition: all 0s ease 0s; min-height: 0px; min-width: 0px; line-height: 64px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-size: 64px;"></span>
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption caption-icon tp-resizeme" 
							id="slide-2-layer-3" 
							data-x="['center','center','center','center']" data-hoffset="['-120','-120','-120','-120']" 
							data-y="['top','top','top','top']" data-voffset="['220','90','220','200']" 
							data-fontsize="['64','64','40','20']"
							data-lineheight="['100','100','100','70']"
							data-width="['100','100','100','70']"
							data-height="['100','100','100','70']"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#03529f;"><span class="icon icon-Screwdriver" style="transition: all 0s ease 0s; min-height: 0px; min-width: 0px; line-height: 64px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-size: 64px;"></span>
							</div>
							
							<!-- LAYER NR. 4 -->
							<div class="tp-caption Photography-Subline   tp-resizeme" 
							id="slide-2-layer-4" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['30','30','60','60']" 
							data-fontsize="['18','18','18','17']"
							data-lineheight="['30','30','30','26']"
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#03529f;">Agrements, Consultations, Forums, Dépôt de Documents
							</div>

							<!-- LAYER NR. 5 -->
							<div class="tp-caption NotGeneric-Title  tp-resizeme rs-parallaxlevel-0" 
							id="slide-2-layer-5" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['90','90','110','90']"
							data-fontsize="['55','55','30','20']"
							data-lineheight="['55','55','55','50']"
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="500" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on"
							
							style="z-index: 6; white-space: nowrap;">En ligne
							</div>
							
							<!-- LAYER NR. 6 -->
							<div class="tp-caption Photography-Subline tp-resizeme" 
							id="slide-2-layer-6" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['160','160','180','160']" 
							data-fontsize="['18','18','18','17']"
							data-lineheight="['30','30','30','26']"
							data-width="['900','900','500','450']"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-basealign="slide" 
							data-responsive_offset="on" 
							
							style="z-index: 6; white-space: nowrap; color:#FFF; text-align:center;">Terminer les Participations couteuses, longue de procédure, sans suite et suivis. Ce Portail met IBC chez vous.
							</div>
						</li>

						<li data-index="rs-12" data-transition="fade" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-description="">
							<!-- MAIN IMAGE -->
							<img src="style/images/Slider/Slider3.jpg" alt="" data-bgposition="center bottom" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
							<!-- LAYERS -->

							<!-- LAYER NR. 1 -->
							<div class="tp-caption NotGeneric-Title  tp-resizeme rs-parallaxlevel-0" 
							id="slide-3-layer-1" 
							data-x="['left','left','left','left']" data-hoffset="['40','100','60','60']"
							data-y="['top','top','top','top']" data-voffset="['200','200','200','200']" 
							data-fontsize="['55','55','55','25']"
							data-lineheight="['55','55','55','20']"
							data-width="450"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
				 
							data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
							data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
							data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
							data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
							data-start="500" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on"
							
							style="z-index: 6; white-space: nowrap;">Chez <span style="z-index: 5; white-space: nowrap; font-size: 55px; line-height: 55px; color:#03529f;">IvoirusBuyer !</span>
							</div>
							
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Photography-Subline tp-resizeme" 
							id="slide-3-layer-2" 
							data-x="['left','left','left','left']" data-hoffset="['40','100','60','60']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['50','60','80','40']" 
							data-fontsize="['18','15','15','12']"
							data-lineheight="['30','30','22','18']"
							data-width="['800','750','400','300']"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
				 
							data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="750" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on" 
							data-responsive="off"

							style="z-index: 6; white-space: nowrap; color:#FFF; text-align:left;">Des Acheteurs Compétants à votre écoute. Forums d'explication entre vous et nos Acheteurs, Rigueur, Ethique dans le Travail. La suite sera d'une grande preuve.
							</div>
													
							<!-- LAYER NR. 3 -->
							<a class="tp-caption rev-btn rev-btn  rs-parallaxlevel-0"  href="<?php echo hash('sha512', 'Forums Agrement' . $login_string);?>"
							id="slide-3-layer-3" 
							data-x="['left','left','left','left']" data-hoffset="['40','100','60','60']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['120','120','180','120']"
							data-fontsize="['14','14','12','8']"
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Linear.easeNone;"
							data-style_hover="c:rgba(51, 51, 51, 1.00);bg:rgba(255, 255, 255, 1.00);"
				 
							data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="1750" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on" 
							data-responsive="off"
							
							style="z-index: 14; white-space: nowrap; font-size: 14px; line-height: 40px; text-transform:uppercase; font-weight: 600; color: rgb(255, 255, 255);font-family:Open Sans;background-color:rgb(0, 76, 153);padding:0px 30px 0px 30px;border-color:rgba(0, 0, 0, 1.00);border-width:2px;border-radius:2px;">Agrements
							</a>


							<!-- LAYER NR. 4 -->
							<a class="tp-caption rev-btn rev-btn  rs-parallaxlevel-0"  href="Menu/?lab=<?php echo hash('sha512', 'Forums Appel' . $login_string);?>"
							id="slide-3-layer-4" 
							data-x="['left','left','left','left']" data-hoffset="['240','300','340','250']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['120','120','180','120']"
							data-fontsize="['14','14','12','8']"												
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
							data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Linear.easeNone;"
							data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgb(0, 76, 153);"
							
							data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="1750" 
							data-splitin="none" 
							data-splitout="none" 
							data-responsive_offset="on" 
							data-responsive="off"
							
							style="z-index: 14; white-space: nowrap; font-size: 14px; line-height: 40px; text-transform:uppercase; font-weight: 600; color: rgb(0, 0, 0);font-family:Open Sans;background-color:rgb(255, 255, 255);padding:0px 30px 0px 30px;border-color:rgba(0, 0, 0, 1.00);border-width:2px;border-radius:2px;">Appel d'Offre
							</a>
							
							<!-- LAYER NR. 5 -->
							<div class="tp-caption tp-resizeme rs-parallaxlevel-5" 
							id="slide-3-layer-5" 
							data-x="['right','right','center','center']" data-hoffset="['0','0,'50','100']" 
							data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" 
							data-width="none"
							data-height="none"
							data-whitespace="nowrap"
							data-transform_idle="o:1;"
				 
							data-transform_in="x:right;s:1500;e:Power3.easeOut;" 
							data-transform_out="opacity:0;s:1500;e:Power4.easeIn;s:1500;e:Power4.easeIn;" 
							data-start="2500" 
							data-responsive_offset="on" 
						
							style="z-index: 5;"><img alt="" src="style/images/Slider/img-3.png" data-no-retina>
							</div>
						</li>

					</ul>
				</div>
			</div>

			<!-- End Revelation Slider -->	
		</header>
		<!-- End Section Header style1 -->


		<!-- Start Our Agrements -->

		<section id="Services" class="whitesmoke-wrapper">
			<div class="container inner">
				<div class="row">
					<div class="col-md-12">
						<div class="title-section text-center">
						<p>RFI</p>
							<h3>Agréments</h3>
						</div>
						<div class="description-welcome text-center">
							<p>Il désigne l'accord donné par une autorité à la nomination d'une personne ou à l'exécution d'un projet nécessitant son autorisation ou son avis préalable.</p>
						</div>
					</div>
				</div>
				<div class="divcod55"></div>
				<div class="row">
					<?php
						foreach ($fetchApproval as $value){?>
							<div class="col-xs-12 col-sm-6 col-lg-3 col-md-3">
								<div class="services-block-img text-center services-style2">
									<img src="style/images/page/service-1.png" alt="">
									<div class="block-services">
										<i class="icon <?php if($idDom == 1){?>icon-road
										<?php }elseif($idDom == 2) {?>icon-th-large
										<?php }elseif($idDom == 3) {?>icon-building
										<?php }elseif($idDom == 4) {?>icon-Wrench
										<?php }elseif($idDom == 5) {?>icon-leaf
										<?php }elseif($idDom == 6) {?>icon-home
										<?php }elseif($idDom == 7) {?>icon-flag-checkered
										<?php }elseif($idDom == 8) {?>icon-truck
										<?php }elseif($idDom == 9) {?>icon-folder-open-alt
										<?php }elseif($idDom == 10) {?>icon-folder-open
										<?php }?>"></i>
										<h4><a href="#"><?php echo $value[1];?></a></h4>
										<p>Agrément : <?php echo $value[2];?>.<br/>Période : <?php echo $value[3];?></p>
										<a class="btn btn-grey" href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Agrement' . $login_string);?><?php echo hash('sha512', 'q=' . $login_string);?><?php echo $value[0];?>">La suite</a>

									</div>
								</div>
							</div>
					<?php	}
					unset($fetchApproval,$value);
					?>

				</div>
				<div class="row">
					<div class="col-md-12 none-padding">
						<div class="home-call-to-action">
							<a class="btn btn-grey" href="Menu/?lab=<?php echo hash('sha512', 'Participer a un Agrement' . $login_string);?>" title="Plus de Details">Plus de Details</a>
							<p>Cet lien vous emène vers le menu des Agréments. Reférez vous au menu plus haut pour plus de traitement</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- End Our Services -->
		
		<!-- Start Our Clients -->

		<section id="Clients" class="light-wrapper">
			<div class="container inner">
				<div class="row">
					<div class="col-md-12">
						<div class="title-section text-center">
							<p>ILS NOUS FONT CONFIANCE</p>
							<h3>Nos Clients</h3>
						</div>
						<div class="description-welcome text-center">
							<p>Nos clients sérieux. ceux qui avec qui nous travaillons et qui sont avec nous depuis le début</p>
						</div>
					</div>
				</div>					
				<div class="divcod55"></div>
				<div class="row">
					<div class="col-md-12">
						<div id="Our-clients" class="owl-carousel owl-theme">
							<a href="#" class="item-client"><img src="style/images/customer/customer-1.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-2.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-3.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-4.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-5.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-6.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-1.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-2.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-3.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-4.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-5.png" alt="customer" width="170" height="68"></a>
							<a href="#" class="item-client"><img src="style/images/customer/customer-6.png" alt="customer" width="170" height="68"></a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- End Our Clients  -->

		<!-- Start Footer -->

		<footer id="footer" class="site-footer footer-style1">
			<div class="container">
				<div class="row">
					<div class="top-footer">
						<div class="col-xs-12 col-md-8">
							<div class="about-footer-box footer-box">
								<div class="footer-box-item">
									<span class="icon icon-Phone2"></span>
									<div class="footer-box-txt">
										<h6>CONTACT</h6>
										<p>N'hésitez pas appeler nous : <span>(+225) 000 00 000</span></p>
										<p>Email au: <span>portail-frs@Ivoiruss.com</span></p>
									</div>
								</div>
								<div class="footer-box-item">
									<span class="icon icon-Pointer"></span>
									<div class="footer-box-txt">
										<h6>Addresse</h6>
										<p>Cote d'Ivoire, Abidjan 225</p>
										<p>Cocody Centre Lycée Mermoze.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="contacts-footer-box footer-box">
								<div class="footer-box-follow">
									<span class="icon icon-Heart"></span>
									<div class="footer-box-txt">
										<h6>NOUS SUIVRE</h6>
										<div class="fotter-follow">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="bottom-footer">
						<div class="col-xs-12 col-md-3">
							<div class="footer-block">
								<h6>&Agrave; Propos</h6>
								<div class="textwidget">
									<p>Nous somme une société de Formation et Vente de logiciel Métier. Notre domaine de definition est les Processus Achat/Appro/Stock et autre en entreprise</p>
								</div>
							</div>
							<div class="Newsletter">
								<form id="suscribe" action="../sigin_up/new_letrer.php" method="post">
									<input type="email" value="" placeholder="Souscrire à notre Newsletter" name="EMAIL" class="txt-box required email" id="mce-EMAIL">
									<button type="submit" name="Souscrire" id="mc-embedded-subscribe" class="button btn btnjoin"><i class="fa fa-angle-right"></i></button>
								</form>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="footer-block">
								<h6>Heures de Travail</h6>
								<div class="textwidget">
									<p>Ouvert les Jours :</p>
									<div class="date-value">
										Lundi - Vendredi : 8H00 à 17H35<br>
										Samedi : 9H00 to 12H00
									</div>
									<p>Vacations :</p>
									<div class="date-value">
										All Sunday Days<br>
										All Official Holidays
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="footer-block">
								<h6>Latest Tweets</h6>
								<div id="tweets-footer" class='tweet query footer'></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="footer-block">
								<h6>Partenaire</h6>
								<ul class="news-footer">
									<li>
										<a href="#"><img src="../style/images/page/ournews-1.png" alt=""></a>
										<h6><a href="#">CKS</a></h6>
										<span class="news-date">le : <a href="#">May 13, 2010</a></span>
									</li>
									<li>
										<a href="#"><img src="../style/images/page/ournews-2.png" alt=""></a>
										<h6><a href="#">Asteck</a></h6>
										<span class="news-date">le : <a href="#">May 13, 2010</a></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<!-- End Footer  -->

		<!-- Start Footer Bootom  -->

		<div id="bottom-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-sm-7">
						<div class="copyright">
							<p>Portails Fournisseur IBC © All Rights Reserved. With Love by <a href="http://www.jm_corps.com">JM Corps</a> <label class="footer-link"><a href="#">Privacy Policy</a> - <a href="#">Terms of Use</a></label></p>

						</div>
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="footer-nav">
							<ul class="nav-ul">
								<li><a href="./">Accueil</a></li>
								<li><a href="about.html">&Agrave; Propos</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- End Footer Bootom -->

	</div>
	
	<!-- Back to top Link -->
	<div id="to-top" class="main-bg"><span class="fa fa-chevron-up"></span></div>
</div>


<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="style/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="style/js/bootstrap.min.js"></script>
<script type="text/javascript" src="style/js/jquery.flexnav.js"></script>

<script type="text/javascript" src="style/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/jquery.themepunch.tools.min.js"></script>

<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="style/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>

<script type="text/javascript" src="style/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="style/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="style/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="style/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="style/js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="style/js/jquery.inview.min.js"></script>
<script type="text/javascript" src="style/js/jflickrfeed.min.js"></script>
<!-- <script type="text/javascript" src="style/js/tweetie.min.js"></script> -->

<script type="text/javascript" src="style/js/modernizr.custom.js"></script>
<script type="text/javascript" src="style/js/classie.js"></script>
<script type="text/javascript" src="style/js/main.js"></script>
<script type="text/javascript" src="style/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="style/js/wow.min.js"></script>
<script type="text/javascript" src="style/js/custom.js"></script>
</body>

</html>