$(function(){
	$('#ModalInfo form').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
 
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
 
        $.ajax({
            url : '../account.php';
            type: 'post',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response == 'success') {
					$.notify('Vos informations ont été modifiées avec succès.', {globalPosition: 'bottom right',  className: 'success'});
					$('#ModalInfo').modal('hide');
					$('#ModalInfo form')[0].reset();
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
    
    
    
    
    $('#ModalPassword form').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
 
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
 
        $.ajax({
            url: '../account.php',
            type: 'post',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response == 'success') {
					$.notify('Le mot de passe a été modifié avec succès.', {globalPosition: 'bottom right',  className: 'success'});
					$('#ModalPassword').modal('hide');
					$('#ModalPassword form')[0].reset();
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


