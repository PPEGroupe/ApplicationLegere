$(function() {
    InitializeMoreDetails();
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #optionButtons').remove();
        
        var html;
        html  = '<tr id="optionButtons" class="toSelect">';
        html +=     '<td colspan="8">';
        html +=         '<div class="btn-group" role="group">';
        html +=             '<button class="btn btn-warning btn-lg" id="moreDetails">Plus de détails</button>';
        html +=             '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postulateModal" id="postulate">Postuler</button>';
        html +=         '</div>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    
        InitializeMoreDetails();
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

function InitializeMoreDetails() {
    $('#moreDetails').click(function () {
        $.post(
            'models/getOfferDetails.php',
            {
                idOffer : KeepNumber($('.offer.active').attr('id'))
            },
            function (data) {
                var offer = data['Offer'];
                var client = data['Client'];
                var typeOfContract = data['TypeOfContract'];
                $('#detailsModal #company').html(client['Company']);
                $('#detailsModal #title').html(offer['Title']);
                $('#detailsModal #reference').html(offer['Reference']);
                $('#detailsModal #typeOfContract').html(typeOfContract['Label']);
                $('#detailsModal #address').html(offer['Address']);
                $('#detailsModal #city').html(offer['City']);
                $('#detailsModal #zipCode').html(offer['ZipCode']);
                $('#detailsModal #dateStartContract').html(offer['DateStartContract']);
                $('#detailsModal #jobQuantity').html(offer['JobQuantity']);
                $('#detailsModal #jobDescription').html(offer['JobDescription']);
                $('#detailsModal #profileDescription').html(offer['ProfileDescription']);
                var longitude = offer['Longitude'];
                var latitude  = offer['Latitude'];
                console.log(offer);
                console.log(longitude);
                console.log(latitude);
                var latlng = new google.maps.LatLng(longitude, latitude);
                //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
	            //de définir des options d'affichage de notre carte
                var options = {
	            	center: latlng,
	            	zoom: 19,
	            	mapTypeId: google.maps.MapTypeId.ROADMAP
	            };
                //constructeur de la carte qui prend en paramêtre le conteneur HTML
	            //dans lequel la carte doit s'afficher et les options
                var carte = new google.maps.Map(document.getElementById("carte"), options);
                
                //création du marqueur
                var marqueur = new google.maps.Marker({
                    position: new google.maps.LatLng(longitude, latitude),
                    map: carte
                });
                
                $('#detailsModal').modal('show');
            },
            'json'
        )
        .fail(function (data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        });
    });
}

