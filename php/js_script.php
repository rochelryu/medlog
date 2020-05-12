<?php
	$dir = "http://www.portail_fournisseur.com/telecharger.php?file=";
	$file = "document.doc";
?>
<script>
$(document).ready(function() {
    $('#box-alert').hide();
    $('#reponse_no').hide();
    $('#reponse_yes').hide();

	$('#lunch').click(function(e) {
		document.location.href = '<?php echo $dir.$file;?>';
   			//console.log(404);		
							 });

    var validator = $("#add-conference").validate({
        ignore: ".ignore",
        rules: {
            city: {
                required: function() {
                    if ($("#pass").val()) {
                        return false;
                    } else {
                        return true;
                    }
                }
            },
            country: {
                required: function() {
                    if ($("#approuv").val()) {
                        return false;
                    } else {
                        return true;
                    }
                }
            },
            "hiddenRecaptcha": {
                required: function() {
                    if(grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
    });

    $('#inscription').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
 
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json', // selon le retour attendu
            data: data,
            success: function (datas) {
        // La réponse du serveur

                if(datas.retruns == 'aborted'){
                    $('#box-alert').show('slow');
                    $('#reponse_no').show('slow');
                    window.setTimeout(function() { location.reload();}, 8000);

                }else if(datas.retruns == 'inserted'){
                    $('#box-alert').show('slow');
                    $('#reponse_yes').show('slow');
                    window.setTimeout(function() { 
                        document.location.href = 'http://www.portail_fournisseur.com/Espace/';
                    }, 5000);
                }

            }
        });
		window.setTimeout(function() {
		$(".alert").fadeTo(800, 0).slideUp(500, function(){
			$(this).remove();
            $("#box-alert").hide();
            $('#reponse_no').hide();
            $('#reponse_yes').hide();
		});
	}, 8000);

    });

	$('#dom').change(function(e) {
		var dom = $(this).val();
        $.ajax({
		type: "GET",
		url: "../php/details_domaine.php",
		data: 'id_dom='+dom,
		success: function(data){

    var sel = $("#det_dom");
    sel.empty();  
	sel.html(data);
  			
		}
    });
	 });
 });
</script>