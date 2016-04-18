$(function() {
	$('#informationModal form').on('submit', function (e) {
        $.post(
            'models/updateAccountClient.php',
            {
                company:       $('#company').val(),
                email:         $('#email').val(),
                phoneNumber:   $('#phoneNumber').val(),
                fax:           $('#fax').val(),
                url:           $('#url').val(),
                address:       $('#address').val(),
                city:          $('#city').val(),
                zipCode:       $('#zipCode').val()
            },
            function(data){
                if(data == 'success'){
                    console.log(data);
                    $.notify('Votre compte a été mis à jour.', {globalPosition: 'bottom right',  className: 'success'});
                    $('#informationModal').modal('hide');
                    $('#companyValue').html($('#company').val());
                    $('#emailValue').html($('#email').val());
                    $('#phoneNumberValue').html($('#phoneNumber').val());
                    $('#faxValue').html($('#fax').val());
                    $('#urlValue').html($('#url').val());
                    $('#addressValue').html($('#address').val());
                    $('#cityValue').html($('#city').val());
                    $('#zipCodeValue').html($('#zipCode').val());
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
    
    $('#passwordModal form').on('submit', function (e) {
        $.post(
            'models/updatePasswordClient.php',
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
                    console.log('else');
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
});


