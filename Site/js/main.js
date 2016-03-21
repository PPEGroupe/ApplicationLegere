$(function(){
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #postulate').remove();
        
        var html;
        html  = '<tr id="postulate">';
        html +=     '<td colspan="6">';
        html +=         '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postulateModal">Postuler</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    });
    
    $('#postulateModal').on('shown.bs.modal', function () {
        var idOffer = KeepNumber($('.offer.active').attr('id'));
        $('#idOffer').val(idOffer);
    });
	
	$('#postulateModal form').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
 
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
 
        $.ajax({
            url: 'models/addPost.php',
            type: 'post',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response == 'success') {
					$.notify('Votre candidature a été envoyée avec succès.', {globalPosition: 'bottom right',  className: 'success'});
					$('#postulateModal').modal('hide');
					$('#postulateModal form')[0].reset();
				} else {
					// Liste chaque erreur dans le sens inverse car il parcourt par la fin
					$.each(response.reverse(), function(key, value) {
						$.notify(value, {globalPosition: 'bottom right',  className: 'error'});
					});
				}
            }
        })
		.fail(function (response) {
			console.log(response['responseText']);
        });
    });
});

// Fonction supprimant les lettre d'une chaine (utilisée pour garder l'identifiant d'un id)
function KeepNumber(str) {
    var again = /[a-zA-Z]/.test(str);
    while (again) {
        str = str.replace(/[a-zA-Z]/g, '');
        again = /[a-zA-Z]/.test(str);
    }
    return str;
}

$.fn.extend({
    findPos : function() {
        obj = jQuery(this).get(0);
        var curleft = obj.offsetLeft || 0;
        var curtop = obj.offsetTop || 0;
        while (obj = obj.offsetParent) {
            curleft += obj.offsetLeft
            curtop += obj.offsetTop
        }
        return {x:curleft, y:curtop};
    }
});