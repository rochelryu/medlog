<?php

if(!empty($auth)) {
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
}

?>
<?php if (!empty($auth)): ?>
<div class="container-fluid">
            <h2>Mise à jour des Informations rélatif à votre Société.</h2>
            <p>Ces informations restent sensible pour la crédibilité de votre Entreprise car elles ont servi à votre l’évaluation pour être agrée. Ces informations sont modifiables tous les ans ainsi que les fichiers d’Agrément postés pour chaque Agrément.</p>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <ul class="m-3 nav nav-tabs bg-color-primary z-depth-3 b-none" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Informations-tab" data-toggle="tab" href="#Informations" role="tab" aria-controls="Informations"
                            aria-selected="true">Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Ressource-Humaine-tab" data-toggle="tab" href="#Ressource-Humaine" role="tab" aria-controls="Ressource Humaine"
                            aria-selected="false">Ressource Humaine</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                            aria-selected="false">Postion Commerciale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Informations-tab-2" data-toggle="tab" href="#chiffres" role="tab" aria-controls="Chiffres d'Affire"
                            aria-selected="true">Chiffres d'Affire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Ressource-Humaine-tab-2" data-toggle="tab" href="#Ressource-Humaine2" role="tab" aria-controls="Contacts"
                            aria-selected="false">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab-2" data-toggle="tab" href="#contact2" role="tab" aria-controls="Questionnement RFI"
                            aria-selected="false">Questionnement RFI</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade card show active" id="Informations" role="tabpanel" aria-labelledby="Informations-tab">
                           <!-- Default form contact -->
                        <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
<input name="update" type="hidden" value="Modifier" />
                            <input type="hidden" name="zone" value="infos">
                            <input type="hidden" name="newEdit" value="<?= (empty($information)) ? '0' : '1' ?>">

                            <p class="h4 mb-4">Informations Générales</p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="text" name="denom" placeholder="Exple : ERK service" value="<?= (empty($information)) ? '' : $information['DENOMINATION'] ?>" required class="form-control">
                                        <label for="inputMDEx">Dénomination</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="text" name="group" value="<?= (empty($information)) ? '' : $information['GROUPE'] ?>"  class="form-control">
                                        <label for="inputMDEx">Groupe</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="text" name="filiale" value="<?= (empty($information)) ? '' : $information['FILIALES'] ?>" class="form-control">
                                        <label for="inputMDEx">Filiale</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <label>Pays du Siège</label>
                                <select required id="siege" name="pays_siege" class="browser-default custom-select ">
                                    <option value="Cote D'ivoire" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Cote D\'ivoire' ? 'selected' : '' ?> >Cote D'ivoire</option>
                                    <option value="Burkina Faso" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Burkina Faso' ? 'selected' : '' ?>>Burkina Faso</option>
                                    <option value="Mali" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Mali' ? 'selected' : '' ?>>Mali</option>
                                    <option value="Benin" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Benin' ? 'selected' : '' ?>>Benin</option>
                                    <option value="Togo" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Togo' ? 'selected' : '' ?>>Togo</option>
                                    <option value="Ghana" <?= (empty($information)) ? '' : $information['PAYS_SIEGE'] == 'Ghana' ? 'selected' : '' ?>>Ghana</option>
                                </select>
                                </div>
                                <div class="col-md-4">
                                <label>Ville du Siège</label>
                                <select required id="siege_v" name="ville_siege" class="browser-default custom-select ">
                                    <option value="Abidjan" <?= (empty($information)) ? '' : $information['VILLE'] == 'Abidjan' ? 'selected' : '' ?> >Abidjan</option>
                                    <option value="Ouagadougou" <?= (empty($information)) ? '' : $information['VILLE'] == 'Ouagadougou' ? 'selected' : '' ?>>Ouagadougou</option>
                                    <option value="Bamako" <?= (empty($information)) ? '' : $information['VILLE'] == 'Bamako' ? 'selected' : '' ?>>Bamako</option>
                                    <option value="Cotonou" <?= (empty($information)) ? '' : $information['VILLE'] == 'Cotonou' ? 'selected' : '' ?>>Cotonou</option>
                                    <option value="Acra" <?= (empty($information)) ? '' : $information['VILLE'] == 'Acra' ? 'selected' : '' ?>>Acra</option>
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="text" name="adress"  value="<?= (empty($information)) ? '' : $information['ADRESSE'] ?>" placeholder="Avenue xx 25 zz y" required class="form-control">
                                        <label for="inputMDEx">Adrèsse</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="text" name="sit_geo" value="<?= (empty($information)) ? '' : $information['SITUATION_GEO'] ?>"  placeholder="Abidjan Avenue" required class="form-control">
                                        <label for="inputMDEx">Situation Géographique</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="tel" required name="tel" value="<?= (empty($information)) ? '' : $information['TELEPHONE'] ?>" class="form-control">
                                        <label for="inputMDEx">Téléphone</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form">
                                        <input type="tel" required value="<?= (empty($information)) ? '' : $information['FAX'] ?>" name="fax" class="form-control">
                                        <label for="inputMDEx">Fax</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="email" name="email_soci" value="<?= (empty($information)) ? '' : $information['EMAIL'] ?>" required class="form-control">
                                        <label for="inputMDEx">Email Société</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" name="site_soci" value="<?= (empty($information)) ? '' : $information['SITE_WEB'] ?>" placeholder="http://www.site.com/" class="form-control">
                                        <label for="inputMDEx">Site Web Société</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="number" name="capital" value="<?= (empty($information)) ? '' : $information['CAPITAL_SOCIAL'] ?>" required class="form-control">
                                        <label for="inputMDEx">Capital Social</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="capito_ext" value="<?= (empty($information)) ? '' : $information['CAPITAUX_ETR'] ?>" required class="form-control">
                                        <label for="inputMDEx">Capitaux Extérieur</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label>Forme Juridique</label>
                                <select required id="form_jur" name="forme" class="browser-default custom-select ">
                                    <option value="SA" <?= (empty($information)) ? '' : $information['VILLE'] == 'SA' ? 'selected' : '' ?> >SA</option>
                                    <option value="SARL" <?= (empty($information)) ? '' : $information['VILLE'] == 'SARL' ? 'selected' : '' ?> >SARL</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <input type="date" name="crea_entr" value="<?= (empty($information)) ? date('Y-m-d') : $information['DATE_CREATION'] ?>" class="form-control">
                                        <label for="inputMDEx">Date de Création Entreprise</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="objet" value="<?= (empty($information)) ? '' : $information['OBJET_SOCIAL'] ?>" required class="form-control">
                                        <label for="inputMDEx">Objet Social</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="immatricu" value="<?= (empty($information)) ? '' : $information['IMMATRICULATION'] ?>" required class="form-control">
                                        <label for="inputMDEx">Immatriculation</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="compte_contr" value="<?= (empty($information)) ? '' : $information['COMPTE_CONTRI'] ?>" required class="form-control">
                                        <label for="inputMDEx">Compte Contribuable</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="regime_fisc" value="<?= (empty($information)) ? '' : $information['REGIME_FISCAL'] ?>" required class="form-control">
                                        <label for="inputMDEx">Regime Fiscal</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="imposition"  value="<?= (empty($information)) ? '' : $information['CENTRE_IMPOSI'] ?>" required class="form-control">
                                        <label for="inputMDEx">Centre D'imposition</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="etabli_bnk" value="<?= (empty($information)) ? '' : $information['ETABLISSEMENT_BANK'] ?>" required class="form-control">
                                        <label for="inputMDEx">Etablissement Bancaire</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label>Pays de la banque</label>
                                <select required id="siege_bnk" name="pays_bnk" class="browser-default custom-select ">
                                    <option value="Cote D'ivoire" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Cote D\'ivoire' ? 'selected' : '' ?> >Cote D'ivoire</option>
                                    <option value="Burkina Faso" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Burkina Faso' ? 'selected' : '' ?>>Burkina Faso</option>
                                    <option value="Mali" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Mali' ? 'selected' : '' ?>>Mali</option>
                                    <option value="Benin" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Benin' ? 'selected' : '' ?>>Benin</option>
                                    <option value="Togo" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Togo' ? 'selected' : '' ?>>Togo</option>
                                    <option value="Ghana" <?= (empty($information)) ? '' : $information['PAYS_BANK'] == 'Ghana' ? 'selected' : '' ?>>Ghana</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                <label>Ville de la Banque</label>
                                <select required id="siege_v_bnk" name="ville_siege_bnk" class="browser-default custom-select ">
                                    <option value="Abidjan" <?= (empty($information)) ? '' : $information['VILLE_BANK'] == 'Abidjan' ? 'selected' : '' ?> >Abidjan</option>
                                    <option value="Ouagadougou" <?= (empty($information)) ? '' : $information['VILLE_BANK'] == 'Ouagadougou' ? 'selected' : '' ?>>Ouagadougou</option>
                                    <option value="Bamako" <?= (empty($information)) ? '' : $information['VILLE_BANK'] == 'Bamako' ? 'selected' : '' ?>>Bamako</option>
                                    <option value="Cotonou" <?= (empty($information)) ? '' : $information['VILLE_BANK'] == 'Cotonou' ? 'selected' : '' ?>>Cotonou</option>
                                    <option value="Acra" <?= (empty($information)) ? '' : $information['VILLE_BANK'] == 'Acra' ? 'selected' : '' ?>>Acra</option>
                                    
                                </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="adress_bnk" value="<?= (empty($information)) ? '' : $information['ADRESSE_BANK'] ?>" required class="form-control">
                                        <label for="inputMDEx">Adrèsse de la Banque</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="num_compte" value="<?= (empty($information)) ? '' : $information['COMPTE_BANK'] ?>" required class="form-control">
                                        <label for="inputMDEx">Numero du Compte</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="rib" value="<?= (empty($information)) ? '' : $information['RIB'] ?>" required class="form-control">
                                        <label for="inputMDEx">RIB</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <input type="text" name="iban" value="<?= (empty($information)) ? '' : $information['IBAN'] ?>" required class="form-control">
                                        <label for="inputMDEx">IBAN</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" name="swift" value="<?= (empty($information)) ? '' : $information['SWIFT'] ?>" required class="form-control">
                                        <label for="inputMDEx">SWIFT</label>
                                    </div>
                                </div>
                                
                                
                            </div>

                            <!-- Send button -->
                            <input class="btn bg-color-primary btn-block" type="submit" value="Modifier" />

                            </form>
                        
                        </div>
                        <div class="tab-pane fade card" id="Ressource-Humaine" role="tabpanel" aria-labelledby="Ressource-Humaine-tab">
                            <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
<input name="update" type="hidden" value="Modifier" />
                                <input type="hidden" name="zone" value="ress">
                                <input type="hidden" name="newEdit" value="<?= (empty($ressource_humaine)) ? '0' : '1' ?>">

                                

                                <p class="h4 mb-4">Ressource Humaine</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' name="nbr_salarie" value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_SALARIES'] ?>" required class="form-control">
                                            <label for="inputMDEx">Nombre de Salariés</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' name="nbr_cadre" value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_CADRE'] ?>" required class="form-control">
                                            <label for="inputMDEx">Nombre de Cadre</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_SALARIES_CNPS'] ?>" name="nbr_salarie_cnps" required class="form-control">
                                            <label for="inputMDEx">Nombre de Salariés CNPS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_SALARIES_CDI'] ?>" name="nbr_salarie_cdi" required class="form-control">
                                            <label for="inputMDEx">Nombre de Salariés CDI</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_SALARIES_CDD'] ?>" name="nbr_salarie_cdd" required class="form-control">
                                            <label for="inputMDEx">Nombre de Salariés CDD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['NBR_TRAVAILLEUR_TEMPO'] ?>" name="nbr_salarie_tempo" required class="form-control">
                                            <label for="inputMDEx">Nbre Travailleur Temporaire</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['PERCENT_SALARIES_CDI'] ?>" step="0.01" name="per_salarie_cdi" required class="form-control">
                                            <label for="inputMDEx">% de Salariés CDI</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['PERCENT_SALARIES_CDD'] ?>" step="0.01" name="per_salarie_cdd" required class="form-control">
                                            <label for="inputMDEx">% de Salariés CDD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['PERCENT_TRAVAILLEUR_TEMPO'] ?>" step="0.01" name="per_salarie_tempo" required class="form-control">
                                            <label for="inputMDEx">% de Salariés Temporaire</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['ANCIENNETE_MOYENNE'] ?>" step="0.01" name="moy_ancien" required class="form-control">
                                            <label for="inputMDEx">Moyenne des Anciens</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['AGE_MOYEN'] ?>" step="0.01" name="moy_age" required class="form-control">
                                            <label for="inputMDEx">Moyenne d'âges</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($ressource_humaine)) ? '' : $ressource_humaine['TAUX_TURN_OVER'] ?>" step="0.01" name="taux" required class="form-control">
                                            <label for="inputMDEx">Taux (TURN OVER)</label>
                                        </div>
                                    </div>
                                </div>

                                <input class="btn bg-color-primary btn-block" type="submit" value="Modifier" />

                            </form>
                        
                        
                        </div>
                        <div class="tab-pane fade card" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
<input name="update" type="hidden" value="Modifier" />
                                <input type="hidden" name="zone" value="posCom">
                                <input type="hidden" name="newEdit" value="<?= (empty($position_commercial)) ? '0' : '1' ?>">
                                <p class="h4 mb-4">Position Commerciale</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="text" name="activit_p" value="<?= (empty($position_commercial)) ? '' : $position_commercial['ACTIVITE_P'] ?>" required class="form-control">
                                            <label for="inputMDEx">Activité Primaire</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="text" name="activit_s" value="<?= (empty($position_commercial)) ? '' : $position_commercial['ACTIVITE_S'] ?>" required class="form-control">
                                            <label for="inputMDEx">Activité Secondaire</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="text" name="marques" value="<?= (empty($position_commercial)) ? '' : $position_commercial['MARQUES'] ?>" required class="form-control">
                                            <label for="inputMDEx">Marques</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-form">
                                            <input type="number" min='0' value="<?= (empty($position_commercial)) ? '' : $position_commercial['NBR_REFERENCE'] ?>" name="nbr_ref" required class="form-control">
                                            <label for="inputMDEx">Nbre Réference</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                                <label class="text-primary">Service Après vente</label>
                                                <div class="form-group">
                                                    
                                                    <!-- Default inline 2-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="serv_after_sell" id="oui" value="1" <?= (empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'] == 1 ? 'checked' : '' ?>  />
                                                        <label class="custom-control-label" for="oui">Oui</label>
                                                    </div>

                                                    <!-- Default inline 3-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="serv_after_sell" id="non" value="0" <?= (empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'] == 0 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="non">Non</label>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                            <input type="text" name="dimenssion" value="<?= (empty($position_commercial)) ? '' : $position_commercial['DIMENTIONS'] ?>" required class="form-control">
                                            <label for="inputMDEx">Dimenssion</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                            <input type="text" name="ref_com" value="<?= (empty($position_commercial)) ? '' : $position_commercial['REFERNCE_COM'] ?>" required class="form-control">
                                            <label for="inputMDEx">Réference Commerciale</label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="text-primary">Etes vous ?</label>
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="etes_vous[]" id="1" value="Fabriquant" <?= strpos((empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'], 'Fabriquant') != false ? 'checked' : '' ?> >
                                                <label class="custom-control-label" for="1">Fabriquant</label>
                                                </div>

                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="etes_vous[]" id="2" value="Distributeur agréé" <?= strpos((empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'], 'Distributeur agréé') != false ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="2">Distributeur agréé</label>
                                                </div>

                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="etes_vous[]" id="3" value="Distributeur" <?= strpos((empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'], 'Distributeur') != false ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="3">Distributeur</label>
                                                </div>

                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="etes_vous[]" id="4" value="Sous-traitant" <?= strpos((empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'], 'Sous-traitant') != false ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="4">Sous-traitant</label>
                                                </div>

                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="etes_vous[]" id="5" value="Importateur" <?= strpos((empty($position_commercial)) ? '' : $position_commercial['SERVICE_AP'], 'Importateur') != false ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="5">Importateur</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="md-form">
                                                    <input type="text" name="etes_vous[]" class="form-control">
                                                    <label for="inputMDEx">Autre (à precisé)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-primary">Secteur d'activité</label>
                                                <div class="form-group">
                                                    
                                                    <!-- Default inline 2-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="secteur" id="oui" value="1" <?= (empty($position_commercial)) ? '' : $position_commercial['SECTEURS_ACTIVITE'] == 1 ? 'checked' : '' ?> />
                                                        <label class="custom-control-label" for="oui">Oui</label>
                                                    </div>

                                                    <!-- Default inline 3-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="secteur" id="non" value="0" <?= (empty($position_commercial)) ? '' : $position_commercial['SECTEURS_ACTIVITE'] == 0 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="non">Non</label>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group purple-border">
                                            <label for="exampleFormControlTextarea4">Vos Clients</label>
                                            <textarea class="form-control" name="client" id="exampleFormControlTextarea4" rows="5"><?= (empty($position_commercial)) ? '' : $position_commercial['CLIENTS'] ?></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label class="text-primary">Type de marcher</label>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                    <!-- Default inline 2-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="type" id="oui" value="1" <?= (empty($position_commercial)) ? '' : $position_commercial['TYPE_MARCHE'] == 1 ? 'checked' : '' ?> />
                                                        <label class="custom-control-label" for="oui">Oui</label>
                                                    </div>

                                                    <!-- Default inline 3-->
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="type" id="non" value="0" <?= (empty($position_commercial)) ? '' : $position_commercial['TYPE_MARCHE'] == 0 ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="non">Non</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="md-form">
                                                    <input type="text" name="lequel" value="<?= (empty($position_commercial)) ? '' : $position_commercial['LE_QUEL'] ?>"  class="form-control">
                                                    <label for="inputMDEx">Lequel</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                                <input type="text" name="prod_serv" value="<?= (empty($position_commercial)) ? '' : $position_commercial['PRODUITS_SERVICE'] ?>"  required class="form-control">
                                                <label for="inputMDEx">Produit Service</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form">
                                                <input type="text" name="ref_entre" value="<?= (empty($position_commercial)) ? '' : $position_commercial['REFRENCE_ENTR'] ?>" required class="form-control">
                                                <label for="inputMDEx">Réference Entreprise</label>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group purple-border">
                                            <label for="orga_com">Organisation Commerciale</label>
                                            <textarea class="form-control" name="orga_com" id="orga_com" rows="3"><?= (empty($position_commercial)) ? '' : $position_commercial['ORGANISATION_COM'] ?></textarea>
                                        </div>
                                    </div>                                    
                                </div>

                                <input class="btn bg-color-primary btn-block" type="submit" value="Modifier" />

                            </form>
                        </div>
                        <div class="tab-pane fade card" id="chiffres" role="tabpanel" aria-labelledby="Informations-tab-2">
                        <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
<input name="update" type="hidden" value="Modifier" />
                                <input type="hidden" name="zone" value="ca">
                                <input type="hidden" name="newEdit" value="<?= (empty($chiffre_four)) ? '0' : '1' ?>">

                                <p class="h4 mb-4">Chiffre D'Affaire</p>

                               <div class="row">
                                    <div class="table-responsive table-bordered table-hover text-nowrap">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Année</th>
                                                    <th scope="col">Chiffre d'Affaire</th>
                                                    <th scope="col">Résultat Net</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($chiffre_four)): ?> 
                                            <?php foreach($chiffre_four as $chiffre): ?>
                                                    <tr>
                                                        <th scope="row"><input type="number" disabled readonly name="N[]" class="form-control" value="<?= $chiffre['ANNEE'] ?>" /></th>
                                                        <td><input type="number" required name="ca[]" class="form-control" value="<?= $chiffre['CA'] ?>"></td>
                                                        <td><input type="number" required name="res_net[]" class="form-control" value="<?= $chiffre['RESULTATS_NET'] ?>"></td>
                                                        
                                                    </tr>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td class="col-md-2 form-group" title="Année N"><input type="number" readonly name="N[]" class="form-control" value="<?php echo date('Y');?>"></td>
                                                    <td><input type="number" name="ca[]" class="form-control" value=""></td>
                                                    <td><input type="number" name="res_net[]" class="form-control" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-2 form-group" title="Année N - 1"><input type="number" readonly name="N[]" class="form-control" value="<?php echo date('Y') - 1;?>"></td>
                                                    <td><input type="number" name="ca[]" class="form-control" value=""></td>
                                                    <td><input type="number" name="res_net[]" class="form-control" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-2 form-group" title="Année N - 2"><input type="number" readonly name="N[]" class="form-control" value="<?php echo date('Y') - 2;?>"></td>
                                                    <td><input type="number" name="ca[]" class="form-control" value=""></td>
                                                    <td><input type="number" name="res_net[]" class="form-control" value=""></td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>

                                    </div>
                               </div>
                                
                               <input class="btn bg-color-primary btn-block" type="submit" value="Modifier" />

                            </form>
                        </div>
                        <div class="tab-pane fade card" id="Ressource-Humaine2" role="tabpanel" aria-labelledby="Ressource-Humaine-tab-2">
                        <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
<input name="update" type="hidden" value="Modifier" />
                                <input type="hidden" name="zone" value="cont">
                                <input type="hidden" name="newEdit" value="<?= (empty($contact_four)) ? '0' : '1' ?>">
                                <p class="h4 mb-4">Contacts Responsable</p>

                               <div class="row">
                                    <div class="table-responsive table-bordered table-hover text-nowrap">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Titre</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénoms</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Email</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($contact_four)): ?>
                                                <?php foreach($contact_four as $contact): ?>
                                                    <tr>
                                                        <th scope="row"><input type="text" disabled readonly name="titre_cnt[]" value="<?= $contact['TITRE'] ?>" class="form-control"></th>
                                                        <td><input type="text" required name="nom_cnt[]" class="form-control" value="<?= $contact['NOM'] ?>"></td>
                                                        <td><input type="text" required name="prenoms_cnt[]" class="form-control" value="<?= $contact['PRENOMS'] ?>"></td>
                                                        <td><input type="text" required name="tel_cnt[]" class="form-control" value="<?= $contact['TELEPHONE'] ?>"></td>
                                                        <td><input type="text" required name="email_cnt[]" class="form-control" value="<?= $contact['EMAIL'] ?>"></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td><input type="text" name="titre_cnt[]" readonly value="Président" class="form-control"></td>
                                                    <td><input type="text" name="nom_cnt[]" class="form-control"></td>
                                                    <td><input type="text" name="prenoms_cnt[]" class="form-control" value=""></td>
                                                    <td><input type="tel" name="tel_cnt[]" class="form-control"></td>
                                                    <td><input type="email" name="email_cnt[]" class="form-control"></td>

                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="titre_cnt[]" readonly value="Directeur Général" class="form-control"></td>
                                                    <td><input type="text" name="nom_cnt[]" class="form-control"></td>
                                                    <td><input type="text" name="prenoms_cnt[]" class="form-control" value=""></td>
                                                    <td><input type="tel" name="tel_cnt[]" class="form-control"></td>
                                                    <td><input type="email" name="email_cnt[]" class="form-control"></td>

                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="titre_cnt[]" readonly value="Directeur Commercial" class="form-control"></td>
                                                    <td><input type="text" name="nom_cnt[]" class="form-control"></td>
                                                    <td><input type="text" name="prenoms_cnt[]" class="form-control" value=""></td>
                                                    <td><input type="tel" name="tel_cnt[]" class="form-control"></td>
                                                    <td><input type="email" name="email_cnt[]" class="form-control"></td>

                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="titre_cnt[]" readonly value="Personne à contacter pour le règlement" class="form-control"></td>
                                                    <td><input type="text" name="nom_cnt[]" class="form-control"></td>
                                                    <td><input type="text" name="prenoms_cnt[]" class="form-control" value=""></td>
                                                    <td><input type="tel" name="tel_cnt[]" class="form-control"></td>
                                                    <td><input type="email" name="email_cnt[]" class="form-control"></td>

                                                </tr>
                                            <?php endif; ?>                                               
                                            </tbody>
                                        </table>

                                    </div>
                               </div>
                                
                               <input class="btn bg-color-primary btn-block" type="submit" value="Modifier" />

                            </form>
                        
                        </div>
                        <div class="tab-pane fade card" id="contact2" role="tabpanel" aria-labelledby="contact-tab-2">
                        <form class="text-center form-chargers border border-light p-5 z-depth-1" action="php/traitement_sigin.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="comp" value="<?php echo $auth['user'];?>">
                                <input name="update" type="hidden" value="Modifier" />
                                <input type="hidden" name="zone" value="files">
                                
                            <p class="mb-4">Telechargement de la fiche de Questionnaire Fournisseurs RFI</p>
                            <span class="badge badge-primary">Veuillez remplire la fiche puis joindre pour la prise en compte de vos informations.</span>
                            <hr>
                            <div class="row">
                                <span>
                                    <a id="lunch" class="btn bg-color-primary"><i class="fa fa-download fa-lg"></i> Télécharger</a>
                                </span>
                            </div>
                            
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-file fa-lg"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fichier[]" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Charger la Fiche Remplie</label>
                                    </div>
                                </div>
                            </div>
                                <input class="btn bg-color-primary btn-block mt-5" type="submit" value="Modifier" />

                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php else: ?>

<script>location.href = location.origin + location.pathname</script>
<?php endif; ?>