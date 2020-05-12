            <div class="col-md-8 col-sm-6">
                <div class="flexbox flex-left-center flex-column">
                    <a id="home"><img src="assets/pictures/logo.png" class='widh-60' alt="" srcset=""></a>
                    <p class="ml-5 slogan h1">Le portails fournisseurs</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 p-v-10 pl-0 pr-0">
                <div class="border-left p-h-10">
                    <form id="signin" method="post" action="javascript:" class="form-authenticate">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h6 class="color-primary">CONNEXION COMPTE</h6>
                            </div>
                            <?php if (empty($auth)): ?>
                              <div class="col-md-7 col-sm-5">
                                <input id="action" name="action" type="hidden" value="portincorps.php" />
                                  <div class="md-form mt-0 mb-0 ">
                                      <input type="text" name="login" auto-complete='off' auto-correct='off' id="inputIconEx2" class="form-control">
                                      <label for="inputIconEx2">Identifiant</label>
                                  </div>
                              </div>
                              <div class="col-md-8 col-sm-5">
                                  <div class="row">
                                      <div class="col-md-9 col-sm-10">
                                          <div class="md-form mt-0 mb-0 ">
                                              <input type="password" name="password" id="inputValidationEx2" class="form-control">
                                              <label for="inputValidationEx2">Mot de passe</label>
                                          </div>
                                      </div>
                                      <div class="col-md-3 col-sm-2 p-0">
                                          <input type="submit" id="loginBtn" class="btn btn-outline-color-primary waves-effect no-over-shadow" value="OK"/>
                                      </div>
                                      <div class="col-md-12 col-sm-12">
                                          <div class="row">
                                              <div class="col-sm-6">
                                                  <a href="#" class="link-authenticate">Mot de passe oublié ?</a>
                                              </div>
                                              <div class="col-sm-6">
                                                  <a href="?p=inscription" class="link-authenticate">Pas encore inscrit ?</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <?php else : ?>
                              <div class="col-md-12">
                                <p class="titleBlock"><?= str_replace ('deg', '°', $auth['name']); ?></p>
                                <div class="logoutDiv">
                                  <a href="logout.php" class="color-primary">Déconnection</a>
                                </div>
                              </div>
                            <?php endif; ?>

                          </div>
                    </form>

                </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <nav class="navbar navbar-expand-sm navbar-dark" id="navbar">

                <!-- Navbar brand -->
                <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i></a>
              
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                  aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">
              
                  <!-- Links -->
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuAgrement" data-toggle="dropdown" >agrément</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuAgrement">
                          <a class="dropdown-item" href="?p=agrements">Participer à un agrément</a>
                          <a class="dropdown-item" href="?p=maj-agrements">Mettre à jour un agrément</a>
                        </div>
                    </li>
                    <?php if (empty($auth)): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="?p=about">A propos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="?p=contact">Contactez-nous</a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuAgrement" data-toggle="dropdown" >appel d'offre</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuAgrement">
                          <a class="dropdown-item" href="?p=appels-offre">Participer à un appel d'offre</a>
                          <a class="dropdown-item" href="?p=maj-appels-offre">Mettre à jour un appel d'offre</a>
                        </div>
                    </li>
                    <!--li class="nav-item">
                      <a class="nav-link" href="#">FORUM
                        <span class="sr-only">(current)</span>
                      </a>
                    </li-->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuAgrement" data-toggle="dropdown" >Gestion des fichiers</a>
                      <div class="dropdown-menu dropdown-primary dropdown-lg" aria-labelledby="navbarDropdownMenuAgrement">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                  <h6 class="color-primary">Contrats</h6>
                                </div>
                                <div class="col-md-12 ">
                                  <ul class="sub-title-menu">
                                    <li><a class="dropdown-item" href="?p=details-clause-confidentialite">Clause de confidentialité</a></li>
                                    <li><a class="dropdown-item" href="?p=details-contrat-annexe">Contrat et Annexe</a></li>
                                    <li><a class="dropdown-item" href="?p=details-avenant">Avenant</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 border-left">
                              <div class="row">
                                <div class="col-md-12">
                                  <h6 class="color-primary">Documents</h6>
                                </div>
                                <div class="col-md-12 ">
                                  <ul class="sub-title-menu">
                                    <li><a class="dropdown-item" href="?p=details-catalogue">Catalogue</a></li>
                                    <li><a class="dropdown-item" href="?p=details-facture">Facture</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuAgrement" data-toggle="dropdown" >Mon Compte</a>
                      <div class="dropdown-menu dropdown-primary dropdown-lg" aria-labelledby="navbarDropdownMenuAgrement">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                  <h6 class="color-primary">Paramêtres</h6>
                                </div>
                                <div class="col-md-12 ">
                                  <ul class="sub-title-menu">
                                    <li><a class="dropdown-item" href="?p=profil-information">Mes informations</a></li>
                                    <li><a class="dropdown-item" href="?p=profil-reglages">Reglages</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 border-left">
                              <div class="row">
                                <div class="col-md-12">
                                  <h6 class="color-primary">Mes resultats</h6>
                                </div>
                                <div class="col-md-12 ">
                                  <ul class="sub-title-menu">
                                    <li><a class="dropdown-item" href="?p=res-agrements">Agréments</a></li>
                                    <li><a class="dropdown-item" href="?p=res-appels-offre">Appel d'offres</a></li>
                                    <li><a class="dropdown-item" href="#">Autre</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php endif; ?>
                  </ul>
                  <!-- Links -->
                </div>
                <!-- Collapsible content -->
              
              </nav>
            </div>