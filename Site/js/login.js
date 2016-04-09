$(function() {
//----------------------------- Inscription ----------------------------- 
    $('#openWebUserRegister').click(function () {
        
        $('#webUserRegisterModal').modal('show');
    });
    
    $('#openClientRegister').click(function () {
        
        $('#clientRegisterModal').modal('show');
    });
    
    $('#openPartnerRegister').click(function () {
        
        $('#partnerRegisterModal').modal('show');
    });
    
//----------------------------- Connexion -----------------------------
    $('#connection').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorConnection').remove();
        $('#error').remove(); // TO DELETE : TEST
        
        // Récupère le Post
        $.post(
            'models/connection.php',
            {
                email:    $('#emailConnection').val(),
                password: $('#passwordConnection').val()
            }, 
            function(data) {
                if (data == 'success') {
                    window.location.href = '/';
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
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        });
    });
    
    
// --------------------------- Insctriptions --------------------------
// 
// *************************** Web User ***************************
    $('#webUserRegister').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorRegister').remove();
        $('#successRegister').remove();
        $.post(
            'models/register.php',
            {
                email:                $('#emailWebUser').val(),
                password:             $('#passwordWebUser').val(),
                passwordConfirmation: $('#passwordConfirmationWebUser').val()
            }, 
            function(data) {
                if (data == 'success') {
                    var html = '<div class="alert alert-success" role="alert" id="successRegister">Inscription validée</div>';
                    $.notify('Inscription validée', {globalPosition: 'bottom right',  className: 'success'});
                    $('#register h2').after(html);
                } else {
                    var html;
                    html  = '<div class="alert alert-warning" role="alert" id="errorRegister">';
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</div>';
                    $('#register h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });
    
 // *************************** Client ***************************
    $('#clientRegister').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorRegister').remove();
        $('#successRegister').remove();
        $.post(
            'models/register.php',
            {
                company:              $('#companyClient').val(),
                email:                $('#emailClient').val(),
                password:             $('#passwordClient').val(),
                passwordConfirmation: $('#passwordConfirmationClient').val()
            }, 
            function(data) {
                if (data == 'success') {
                    var html = '<div class="alert alert-success" role="alert" id="successRegister">Inscription validée</div>';
                    $.notify('Inscription validée', {globalPosition: 'bottom right',  className: 'success'});
                    $('#register h2').after(html);
                } else {
                    var html;
                    html  = '<div class="alert alert-warning" role="alert" id="errorRegister">';
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</div>';
                    $('#register h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });
    
// *************************** Partner ***************************
    $('#partnerRegister').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        // On retire les erreurs qui seraient restées
        $('#errorRegister').remove();
        $('#successRegister').remove();
        $.post(
            'models/register.php',
            {
                company:              $('#companyPartner').val(),
                email:                $('#emailPartner').val(),
                password:             $('#passwordPartner').val(),
                passwordConfirmation: $('#passwordConfirmationPartner').val()
            }, 
            function(data) {
                if (data == 'success') {
                    var html = '<div class="alert alert-success" role="alert" id="successRegister">Inscription validée</div>';
                    $.notify('Inscription validée', {globalPosition: 'bottom right',  className: 'success'});
                    $('#register h2').after(html);
                } else {
                    var html;
                    html  = '<div class="alert alert-warning" role="alert" id="errorRegister">';
                    $.each(data, function(key, value) {
                        html += value + '<br />';
                        // Pop-up de notification notify.js
                        $.notify(value, {globalPosition: 'bottom right',  className: 'error'});
                    });
                    html += '</div>';
                    $('#register h2').after(html);
                }
            }, 
            'json'
        )
        .fail(function(data) {
            console.error(data['responseText']);
        });
    });
});
