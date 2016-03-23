//----------------------------- Inscription ----------------------------- 
$(function() {
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
                html  = '<p id="errorRegister" class="bg-warning">'
                $.each(data, function(key, value) {
                    html += value + '<br />';
                    // Pop-up de notification notify.js
                    $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                });
                html += '</p>';
                $('#register h2').after(html);
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });
});


//----------------------------- Connexion -----------------------------
$(function() {
    $('#connection').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorConnection').remove();
        $.post(
            'models/connection.php',
            {
                email:                $('#emailConnection').val(),
                password:             $('#passwordConnection').val()
            }, 
            function(data) {
                //console.info(data);
                if (data == 'success'){
                    window.location.href = './index.php';
                } else {
                    var html;
                    html  = '<p id="errorConnection" class="bg-warning">'
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</p>';
                    $('#connection h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });
});
