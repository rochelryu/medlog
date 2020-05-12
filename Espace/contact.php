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
        <div class="login-area side-nav-block">
            <div class="title-sidebar">
                <h2>Identification</h2>
            </div>
            <div class="login-controls">
                <div class="input-box">
                    <input type="text" name="name" class="txt-box " placeholder="User name">
                </div>
                <div class="input-box">
                    <input type="password" name="pass" class="txt-box " placeholder="Password">
                </div>
                <div class="check-box">
					<label class="lb-remember"><input name="rememberme" type="checkbox" id="rememberme" value="forever">Garder ma session</label>
                    <a href="#">Mot de Passe Oublié?</a>
                </div>
                <div class="main-bg">
                    <input type="submit" name="connexion" class="btn " value="Connexion">
                </div>				
                <div class="Sign-Up">
                    <a href="#">Créer un Compte</a>
                </div>
            </div>
		</div>	
    </nav>
    <button class="close-button" id="close-button">Cache le Menu</button>
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
										<a class="navbar-logo" href="index.html"><img src="../style/images/logo/logo-construction.png" alt=""></a>
									</div>
									<div class="header-icon float-right">
										<div class="site-icons-ul float-right">
											<ul class="icons-ul">
			<li class="sidebar-menu" title="Identification"><a href="#" id="open-button"></a></li>
											</ul>
										</div>
									</div>
									<!-- Start Navbar -->
									<div class="navbar-header float-right">
										<div id="cssmenu" class="Menu-Header top-menu">
											<div class="menu-button"></div>
											<ul class="flexnav one-page" data-breakpoint="992">
						<li class="has-sub"><a href="../">Accueil</a></li>
						<li class="has-sub"><a href="about.html">&Agrave; Propos</a></li>
						<li class="has-sub"><a href="service.html">Services</a></li>
						<li class="has-sub"><a href="contact.php">Contact</a></li>
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
			
			<!-- Start Pages Title  -->
			
			<section id="Page-title" class="Page-title-Style1">
				<div class="color-overlay"></div>
				<div class="container inner-page-title">
					<div class="inner-title-container">
						<div class="row">
							<div class="col-md-9 col-sm-9">
								<div class="title-icon"><span class="icon icon-Ringer"></span></div><div class="title-text"><h2 class="page-title">Portail IBC</h2><h6>Fournisseurs</h6></div>
							</div>
							<div class="col-md-3 col-sm-3">                  
								<div class="breadcrumb-trail breadcrumbs"><span class="trail-begin"><a href="#" title="Helmets">Accueil</a></span>
									 <span class="sep">/</span> <span class="trail-end">IvoirusBuyer Consulting</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<!-- End Pages Title  -->
		
		</header>

		<!-- End Section Header style1 -->

		<!-- Start Our Why Us -->

		<!-- Start Contact Us -->

		<div id="Contact" class="light-wrapper">
			<div class="container inner">
				<div class="row">
					<div class="col-md-12">
						<!-- Start Map Style1 -->
						<div id="Map-Style" class="light-wrapper">
							<div id="map_canvas"></div>
							<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
							<script>
							// This example displays a marker at the center of Australia.
							// When the user clicks the marker, an info window opens.

							function initialize() {
							  var myLatlng = new google.maps.LatLng(44.5403, -78.5463);
							  var mapOptions = {
								zoom: 10,
								center: myLatlng,
								  zoomControl: false,
								  scaleControl: false,
								  scrollwheel: false,
								  disableDoubleClickZoom: true,
							  };

							  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

							  var contentString = '<div id="content">'+
								  '<h3>7oroof Inc.</h3><p>25, 245 Street Name, Address, City</p>'+
								  '</div>';

							  var infowindow = new google.maps.InfoWindow({
								  content: contentString
							  });

							  var marker = new google.maps.Marker({
								  position: myLatlng,
								  map: map,
								  title: 'Uluru (Ayers Rock)'
							  });
							  google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map,marker);
							  });
							}

							google.maps.event.addDomListener(window, 'load', initialize);

							</script>

						</div>
						<!-- End Map Style1 -->
					</div>
				</div>
				<div class="divcod70"></div>
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="Contact-Form">
								<form class="leave-comment contact-form" method="post" action="style/php/contact.php" id="cform" autocomplete="on">
									<div class="Contact-us">
										<div class="form-input col-md-6">
											<input type="text" name="name" placeholder="Your Name" required>
										</div>
										<div class="form-input col-md-6">
											<input type="email" name="email" placeholder="Email" required>
										</div>
										<div class="form-input col-md-12">
											<textarea class="txt-box textArea" name="message" cols="40" rows="7" id="messageTxt" placeholder="Message" spellcheck="true" required></textarea>
										</div>
										<div class="form-submit col-md-12">
											<input type="submit" class="btn btn-large main-bg" value="Send Message">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="Contact-Info">
							<div class="tex-contact">
								<p>Lorem ipsum dolor sit amet, adipiscing condimentum tristique vel, eleifend sed turpis. Amet, consectetur adipising elit Integer.</p>
							</div>
							<div class="Block-Contact col-md-6">
								<p>Phone :</p>
								<ul>
									<li>
										<i class="fa fa-phone"></i>
										<span>+ 2 01065370701</span>
									</li>
									<li>
										<i class="fa fa-fax"></i>
										<span>+ 2 01065370701</span>
									</li>
								</ul>
							</div>
							<div class="Block-Contact col-md-6">
								<p>Email :</p>
								<ul>
									<li>
										<i class="fa fa-envelope"></i>
										<span>7oroof@7oroof.com</span>
									</li>
								</ul>
							</div>
							<div class="Block-Contact col-md-12">
								<p>Address :</p>
								<ul>
									<li>
										<i class="fa fa-map-marker"></i>
										<span>2 AlBahr St, Tanta , AlGharbia, Egypt.</span>
									</li>
								</ul>
							</div>				
						</div>		
					</div>
				</div>
			</div>
		</div>

		<!-- End Contact Us -->
		
		<!-- Start Footer -->

		<footer id="footer" class="site-footer">
			<div class="container">
				<div class="row">
					<div class="top-footer">
						<div class="col-xs-12 col-md-8">
							<div class="about-footer-box footer-box">
								<div class="footer-box-item">
									<span class="icon icon-Phone2"></span>
									<div class="footer-box-txt">
										<h6>CONTACT</h6>
										<p>Don't Hesitate To Call Us: <span>+2 01065370701</span></p>     
										<p>Email Us At: <span>7oroof@7oroof.com</span></p>     
									</div>	
								</div>	
								<div class="footer-box-item">
									<span class="icon icon-Pointer"></span>
									<div class="footer-box-txt">
										<h6>Address</h6>
										<p>Alnahas Building, Flat 35</p>                                                                                                               
										<p>2 AlBahr St, Tanta , AlGharbia, Egypt.</p>                                                                                                               
									</div>	
								</div>								
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="contacts-footer-box footer-box">
								<div class="footer-box-follow">
									<span class="icon icon-Heart"></span>
									<div class="footer-box-txt">
										<h6>FOLLOW US</h6>
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
								<h6>About Us</h6>
								<div class="textwidget">
									<p>Helmets is a business theme which perfectly suited Construction company, Cleaning agency, Mechanic workshop and any kind of handyman business.</p>
								</div>
							</div>
							<div class="Newsletter">
								<form action="#" method="post">
									<input type="email" value="" placeholder="Subscribe In Our Newsletter" name="EMAIL" class="txt-box required email" id="mce-EMAIL">
									<button type="submit" name="subscribe" id="mc-embedded-subscribe" class="button btn btnjoin"><i class="fa fa-angle-right"></i></button>
								</form>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="footer-block">
								<h6>Business Hours</h6>
								<div class="textwidget">
									<p>Opining Days :</p>
									<div class="date-value">
										Monday - Friday : 9am to 20 pm<br>
										Saturday : 9am to 17 pm
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
								<h6>Our News</h6>
								<ul class="news-footer">
									<li>
										<a href="#"><img src="style/images/page/ournews-1.png" alt=""></a>
										<h6><a href="#">HOME RENOVATIONS WITH  Modern Style</a></h6>
										<span class="news-date">On : <a href="#">May 13, 2015</a></span>
									</li>
									<li>
										<a href="#"><img src="style/images/page/ournews-2.png" alt=""></a>
										<h6><a href="#">Tips for buying dream house</a></h6>
										<span class="news-date">On : <a href="#">May 13, 2015</a></span>
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
							<p>Helmets © All Rights Reserved. With Love by <a href="http://themeforest.net/user/7oroof/portfolio?ref=7oroof">7oroof.com</a> <label class="footer-link"><a href="#">Privacy Policy</a> - <a href="#">Terms of Use</a></label></p>
							
						</div>
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="footer-nav">
							<ul class="nav-ul">
								<li><a href="#">About</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Project</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Contact</a></li>
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
<script type="text/javascript" src="style/js/tweetie.min.js"></script>

<script type="text/javascript" src="style/js/modernizr.custom.js"></script>
<script type="text/javascript" src="style/js/classie.js"></script>
<script type="text/javascript" src="style/js/main.js"></script>
<script type="text/javascript" src="style/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="style/js/wow.min.js"></script>
<script type="text/javascript" src="style/js/custom.js"></script>
</body>

</html>
