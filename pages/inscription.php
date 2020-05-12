<?php
require_once('php/sigin_data_get.php');

?>
<?php if (empty($auth)): ?>
<div class="fixed">
    <a id='home'><img src="assets/pictures/logo.png" class="img-fluid" alt="" srcset=""></a>
</div>
<div class="container">
    <div class="row pl-3">
        <form id="inscription" name="sigin" action="php/traitement_sigin.php"
          method="post" enctype="multipart/form-data" >
          <input name="incrip" type="hidden" value="Modifier" />
            <div class="card pl-2 pr-2">
            <ul class="stepper linear">
                <li class="step active">
                    <div class="step-title waves-effect">Prerequis</div>
                    <div class="step-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="content-block">
                                        <div class="page-header">
                                            <h4 class='color-grey'>Telechargement de la fiche de Questionnaire Fournisseurs RFI</h4>
                                        </div>
                                        <div class="page-content">
                                            <p class='color-grey'>Veuillez télécharger et remplire la fiche ci-dessous avant de commencer l'inscription.</p>
                                            <hr>
                                            <a id="lunch" class="btn btn-sm btn-primary"><i class="fas fa-file-download"></i> Télécharger</a>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            
                            <button type="button" class="waves-effect waves-dark btn next-step bg-color-primary">CONTINUE</button>
                        </div>
                    </div>
                </li>
                <li class="step">
                    <div class="step-title waves-effect">Compte</div>
                    <div class="step-content">
                        <div class="card">
                            <div class="card-body">
                                <section id="documenter_cover">
                                    <div class="content-block">
                                        <div class="page-header">
                                            <h3 class='color-grey'>COMPTE Fournisseur</h3>
                                        </div>
                                        <div class="page-content">
                                                <h5>Vos informations Relatives à la Connexion</h5>
                                            <hr>
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-5">
                                                        <div class="form-group">
                                                            <label class="text-primary">Code Candidat</label>
                                                            <input type="text" name="code" class="form-control" readonly value="<?php echo $code;?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5">
                                                        <div class="form-group">
                                                            <label class="text-primary">Email</label>
                                                            <input type="email" required  name="email" class="form-control" placeholder="Utilisateur@mail.com" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="form-group">
                                                        <label class="text-primary ">Mot de Passe</label>
                                                        <input type="password" required  name="pass" id="pass" class="form-control" placeholder="**********" value="" />
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="form-group">
                                                        <label class="text-primary">Confirmation</label>
                                                        <input type="password" required name="conf_pass" id="confPass" class="form-control" value="" />
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 col-sm-5">
                                                        <div class="form-group">
                                                        <label class="text-primary">Date d'inscription</label>
                                                        <input type="date" name="date" class="form-control" readonly value="<?php echo date('Y-m-d');?>"/>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="step-actions">
                            
                            <button type="button" class="waves-effect waves-dark btn next-step bg-color-primary">CONTINUE</button>
                        </div>
                    </div>
                </li>
                <li class="step">
                    <div class="step-title waves-effect">Domaine D'exercice</div>
                    <div class="step-content">
                        <div class="card">
                            <div class="card-body">
                            <section id="getting_statred">
                                <div class="content-block">
                                    <div class="page-header"><h3>Domaine d'Exercice</h3></div>
                                    <div class="page-content">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="text-primary">Domaine</label>
                                                    <select name="domaine"  class="form-control" id="dom">
                                                        <option> Listes des Domaines</option>
                                                        <?php
                                                        // Set level for listing
                                                        $select = "";
                                                        $getting->derouler($nivo = 'two',$select);
                                                        //
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="form-group">
                                                    <label class="text-primary">Détails de l'activité</label>
                                                    <textarea id="det_dom" rows="3" class="form-control" name="detail_dom"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="text-primary">Nom Charger</label>
                                                    <input type="text"  class="form-control" name="nom_charger" placeholder="Nom du Charger du compte" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="text-primary">Prénoms Charger du Compte</label>
                                                    <input type="text"  class="form-control" name="prenom_charger" placeholder="Prénoms du Charger du compte" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="form-group">
                                                    <label class="text-primary">Raison de Votre Inscription</label>
                                                    <textarea  class="form-control" rows="3" name="raison"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="text-primary">Poste Charger</label>
                                                    <input type="text"  class="form-control" name="Poste_charger" placeholder="Poste du Charger du compte" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label class="text-primary">Email Charger</label>
                                                    <input type="email" class="form-control" name="email_charger" placeholder="Charger@compte.com" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="text-primary">Signature</label>
                                                    <div class="radio">
                                                        <div class="form-group">
                                                            <label>
                                                                <input type="radio" name="signature" id="oui" value="1" checked /> Oui</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>
                                                                <input type="radio" name="signature" id="non" value="0" /> Non</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            </div>
                        </div>
                        <div class="step-actions">
                            <button type="button" class="waves-effect waves-dark btn-flat color-primary previous-step">Retour</button>
                            <button type="button" class="waves-effect waves-dark btn next-step bg-color-primary">CONTINUE</button>
                        </div>
                    </div>
                </li>
                
                <li class="step">
                    <div class="step-title waves-effect">Finalisation</div>
                    <div class="step-content">
                        <div class="card">
                            <div class="card-body">
                                <section id="credits">
                                    <div class="content-block">
                                        <div class="page-header"><h3>Finalisation</h3></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Charger la Fiche Remplie</label>
                                                    <input type="file"  class="form-control" name="fichier[]"/>
                                                </div>

                                            </div>
                                            <div class="col-md-12 col-sm-12 pull-left">
                                        <textarea  class="form-control " rows="15" style="resize:none" >
                                            <?php include('licence.txt'); ?>
                                        </textarea>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="row">
                                                <div class="col-md-5 col-sm-5">
                                                <div class="checkbox-inline">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" name="approuver" id="approuv" >
                                                            <label class="custom-control-label" for="approuv">J'accepte les Termes et condition d'Utilisations</label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="step-actions">
                            <input type="hidden" name="inscription" value='save'>
                            <button type="button" class="waves-effect waves-dark btn-flat color-primary previous-step">Retour</button>
                            <input type="submit" class="waves-effect waves-dark btn bg-color-primary" value="S'inscrire" />
                        </div>
                    </div>
                </li>
            </ul>
            </div>  
            </form>      
    </div>
</div>
<?php else: ?>
<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>


