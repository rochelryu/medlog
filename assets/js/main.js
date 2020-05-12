$(function() {

    $('.back-guide').click(function(e) {
        console.log('.back-guide')
        $(this).parent().parent().parent().parent().removeClass('show')
    });
    $('#lunch').click(function(e) {
        e.preventDefault()
        window.open(location.origin + location.pathname + '/?d=document.doc', '_blank');
        //console.log(404);		
    });

    $('#lunch1').click(function(e) {
        e.preventDefault()
        window.open(location.origin + location.pathname + '/?d=article_cataloguer.xlsx', '_blank');
        //console.log(404);		
    });
    $('#lunch2').click(function(e) {
        e.preventDefault()
        window.open(location.origin + location.pathname + '/?d=article_details.xlsx', '_blank');
        //console.log(404);		
    });

    $('#form-create').submit(function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();

        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            success: function(datas) {
                console.log('datas', datas)
            }
        });
    });

    $('.form-charger').submit(function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();

        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            success: function(datas) {

                if (datas.result == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 2000,
                        message: 'Mis à jour avec succès.'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname + location.search;
                    }, 2000);
                } else {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'Echec de la mise à jour.'
                    });
                }
            }
        });
    });

    $('.form-chargers').submit(function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();

        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            success: function(datas) {
                if (datas.retruns == 'updated' || datas.retruns == 'inserted') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Mis à jour avec succès.'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname + location.search;
                    }, 4000);
                } else {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'Echec de la mise à jour.'
                    });
                }
            }
        });
    });
    $('#home').on('click', function(e) {
        location.href = location.origin + location.pathname;
    })

    $('#newsletter-form').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'), // obligatoire pour de l'upload
            dataType: 'json',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // selon le retour attendu
            data: data,
            success: function(data) {
                console.log('data', data)
                if (data.resultat == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Nous vous avons bel et bien enregistré'
                    });
                } else if (data.resultat == 'none') {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'L\'Enregistrement a échoué. Veuillez verifier les informations'
                    });
                } else {
                    $.notify({
                        position: 3,
                        type: 'warning',
                        duration: 4000,
                        message: 'L\'Enregistrement a échoué. Veuillez verifier les informations'
                    });
                }
            },

        });
    })
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'), // obligatoire pour de l'upload
            dataType: 'json',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // selon le retour attendu
            data: data,

        });
        $.notify({
            position: 3,
            type: 'info',
            autoClose: false,
            message: 'Votre message a été posté'
        });
    })
    $('#inscription').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.notify({
            position: 3,
            type: 'info',
            autoClose: false,
            message: 'Votre inscription est en cours veuillez patienter s\'il vous plait'
        });
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function(data) {
                console.log('data', data)
                if (data.retruns == 'inserted') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Inscris avec succès. Bienvenue parmi nous'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname;
                    }, 2000);
                } else if (data.retruns == 'aborted') {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'L\'inscription a échoués. Veuillez verifier les informations'
                    });
                } else {
                    $.notify({
                        position: 3,
                        type: 'warning',
                        duration: 4000,
                        message: 'Un tout Autre Problème est survenu. Veuillez contacter l\'Adiminstrateur.'
                    });
                }
            }

        });
    })

    $('#signin').on('submit', function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        /*$('#loginBtn').attr('disabled', '');*/

        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        var uri = 'php/';
        var realPage = '';
        if (data.get('action') == 'portincorps.php') {
            realPage = 'config.php';
        }
        $.ajax({
            url: uri + realPage,
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function(response) {
                //alert(response);
                if (response.exist == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Connexion éffectué avec succès!'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname;
                    }, 2000);

                } else if (response.exist == 'none') {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'Adresse email ou mot de passe incorrect'
                    });
                }
            },
            complete: function() {
                $('#loginBtn').removeAttr('disabled');
            }
        });
    });

    $('#postAgrement').on('click', function(e) {
        var data = new FormData();
        var postId = $('#idAgrement').attr('value');
        var user = $('#idUser').attr('value');
        data.append('by', 'agr');
        data.append('postId', postId);
        data.append('user', user);
        $.ajax({
            url: 'Espace/Traitement/postuler.php',
            type: 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false,
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function(response) {
                console.log('response', response)
                if (response.result == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Vous avez postuler à l\'agrément avec succès!'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname + '?p=maj-agrements';
                    }, 4000);
                } else {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'La requete a échoué car vous avez déjà postulé !'
                    });
                }
            }
        });
    });

    $('#postCalloffer').on('click', function(e) {
        var data = new FormData();
        var postId = $('#idCalloffer').attr('value');
        var user = $('#idUser').attr('value');
        data.append('by', 'offre');
        data.append('postId', postId);
        data.append('user', user);
        $.ajax({
            url: 'Espace/Traitement/postuler.php',
            type: 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false,
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function(response) {
                if (response.result == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'Vous avez postuler à l\'appel d\'offre avec succès!'
                    });
                    window.setTimeout(function() {
                        location.href = location.origin + location.pathname + '?p=maj-appels-offre';
                    }, 4000);
                } else if (response.result == 'none') {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'La requete a échoué car vous avez déjà postulé !'
                    });
                }
            }
        });
    });

    $('#uploadFile').on('submit', function(e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: data.get('action'),
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function(data) {
                if (data.resultat == 'ok') {
                    $.notify({
                        position: 3,
                        type: 'success',
                        duration: 4000,
                        message: 'La mise à jour des fichiers existants a été éffectuer avec succès.'
                    });
                    setTimeout(() => {
                        location.href = location.origin + location.pathname + location.search;
                    }, 4000)
                } else if (data.resultat == 'none') {
                    $.notify({
                        position: 3,
                        type: 'error',
                        duration: 4000,
                        message: 'La mise à jour des fichiers a échoués.'
                    });
                } else {
                    $.notify({
                        position: 3,
                        type: 'warning',
                        duration: 4000,
                        message: 'Un tout Autre Problème est survenu. Veuillez contacter l\'Adiminstrateur.'
                    });
                }
            }
        });
    });
});