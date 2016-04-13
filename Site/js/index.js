var map;
var marker;
var latitude, longitude;
$(function() {
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
    
    $('#detailsModal').on('shown.bs.modal', function () {
        $('#displayMap').hide();
        
        if(!$('#errorMap').is(":visible")) {
            $('#map').show();
        }
        InitializeMap();
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
            $('#error').remove();
            $('body').append('<div id="error">' + response['responseText'] + '</div>');
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
				console.info(data);
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
                $('#detailsModal #dateStartContract').html(DateFormat(offer['DateStartContract']));
                $('#detailsModal #jobQuantity').html(offer['JobQuantity']);
                $('#detailsModal #jobDescription').html(offer['JobDescription']);
                $('#detailsModal #profileDescription').html(offer['ProfileDescription']);
                
                latitude = offer['Latitude'].trim();
                longitude = offer['Longitude'].trim();
                                
                $('#errorMap').remove();
                $('#map').hide();
                if (latitude == '' || longitude == '') {
                    $('#mapContainer').prepend('<div class="alert alert-warning" role="alert" id="errorMap">Adresse non trouvée</div>');
                }
                
                $('#detailsModal').modal('show');
                
                $.post(
                    'models/addOfferView.php',
                    {
                        idOffer : KeepNumber($('.offer.active').attr('id'))
                    }
                );
            },
            'json'
        ).fail(function(data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        });
    });
}

function InitializeMap() {
    var latlng = new google.maps.LatLng(latitude, longitude);

    var options = {
        center: latlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map"), options);

    marker = new google.maps.Marker({
         position: latlng,
         map: map
    });
}

