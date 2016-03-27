$(function() {
    //----------------------------- Inscription ----------------------------- 
    $('#register').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorRegister').remove();
        $.post(
            'models/register.php',
            {
                company:              $('#companyRegister').val(),
                email:                $('#emailRegister').val(),
                password:             $('#passwordRegister').val(),
                passwordConfirmation: $('#passwordConfirmationRegister').val()
            }, 
            function(data) {
                //console.info(data);
                var html;
                html  = '<div class="alert alert-warning" role="alert" id="errorRegister">';
                $.each(data, function(key, value) {
                    html += value + '<br />';
                    // Pop-up de notification notify.js
                    $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                });
                html += '</div>';
                $('#register h2').after(html);
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });

    //----------------------------- Connexion -----------------------------
    $('#sendConnectionClient').click(function () {
        // On retire les erreurs qui seraient restées
        $('#errorConnection').remove();
        $.post(
            'models/connectionClient.php',
            {
                email:    $('#emailConnection').val(),
                password: $('#passwordConnection').val()
            }, 
            function(data) {
                //console.info(data);
                if (data == 'success'){
                    window.location.href = './index.php';
                } else {
                    var html;
                    html  = '<div class="alert alert-warning" role="alert" id="errorConnection">';
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</div>';
                    $('#connection h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
        
        return false;
    });
    
    $('#sendConnectionPartner').click(function () {
        // On retire les erreurs qui seraient restées
        $('#errorConnection').remove();
        $.post(
            'models/connectionPartner.php',
            {
                email:    $('#emailConnection').val(),
                password: $('#passwordConnection').val()
            }, 
            function(data) {
                //console.info(data);
                if (data == 'success'){
                    window.location.href = './index.php';
                } else {
                    var html;
                    html  = '<div class="alert alert-warning" role="alert" id="errorConnection">';
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</div>';
                    $('#connection h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
        
        return false;
    });
});
