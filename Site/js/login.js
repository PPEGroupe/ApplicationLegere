$(function() {
   $('#register').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();

        $.post(
               'models/register.php',
              {
                  company:              $('#companyRegister').val(),
                  email:                $('#emailRegister').val(),
                  password:             $('#passwordRegister').val(),
                  passwordConfirmation: $('#passwordConfirmationRegister').val()
              }, 
               function(data) {
                   console.info(data);

                   $.each(data, function(key, value) {
                       $('section').append('<div class="category"><a href="product.html?id=' + value['Identifier'] + '">' + value['Label'] + '</a></div>');
                   });
               }, 
               'json'
            ).fail(function(data) {
               console.error(data['responseText']);
       });
    });
});

