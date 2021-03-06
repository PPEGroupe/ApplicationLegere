// Vérifie et enregistre les changements du compte partner
$(function() {
	$('#informationModal form').on('submit', function (e) {
        $.post(
            'models/updateAccountPartner.php',
            {
                email:         $('#email').val(),
                url:           $('#url').val()
            },
            function(data){
                if(data == 'success'){
                    $.notify('Votre compte a été mis à jour.', {globalPosition: 'bottom right',  className: 'success'});
                    $('#informationModal').modal('hide');
                    $('#emailValue').html($('#email').val());
                    $('#urlValue').html($('#url').val());
                } else {
                    $.each(data.reverse(), function(key, value) {
			$.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                }
            },
            'json'
            
        )
        .fail(function(data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        }); 
        return false;
    });
    
    //Vérifie le changement de mot de passe 
    $('#passwordModal form').on('submit', function (e) {
        
        $.post(
            'models/updatePassword.php',
            {
                oldPassword:            $('#oldPassword').val(),
                newPassword:            $('#newPassword').val(),
                passwordConfirmation:   $('#passwordConfirmation').val()
            },
            function(data){
                if(data == 'success'){
                    $.notify('Votre mot de passe a été mis à jour.', {globalPosition: 'bottom right',  className: 'success'});
                    $('#passwordModal').modal('hide');
                    $('#passwordModal form')[0].reset();
                } else {
                    $.each(data.reverse(), function(key, value) {
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                }
            },
            'json'
       )
        .fail(function(data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        }); 
        return false;
    });
    
    $('#copy').click(function () {
        $(this).notify('Copié !', {position: 'top',  className: 'alert'});
    });
});