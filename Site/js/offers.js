$(function(){
	// Séléction d'une offre
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #displayPosts').remove();
        
        var html;
        html  = '<tr id="displayPosts" class="toSelect">';
        html +=     '<td colspan="5">';
        html +=         '<div class="btn-group" role="group">';
        html +=             '<button class="btn btn-warning btn-lg" id="moreDetails">Plus de détails</button>';
        html +=             '<button class="btn btn-warning btn-lg" id="openPosts">';
        html +=                 'Voir les candidatures <span class="label label-warning">' + $(this).children('.hidden').html() + '</span>';
        html +=             '</button>';
        html +=         '</div>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
		
        InitializeDisplayPosts();
        InitializeMoreDetails();
    });
	
	// Lorsque la modal postDetailsModal se ferme
	$('#postDetailsModal').on('hide.bs.modal', function (event) {
        $('#postsModal').modal('show');
	});
});

function InitializePost() {
	// Sélection d'une candidature
    $('.post').click(function() {
        $('.post.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#posts #displayDetails').remove();
        
        var html;
        html  = '<tr id="displayDetails" class="toSelect">';
        html +=     '<td colspan="7">';
        html +=         '<button class="btn btn-warning btn-lg">';
        html +=             'Plus de détails';
        html +=         '</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
		
        InitializeDisplayPostDetails();
    });
}

function InitializeDisplayPosts() {
    // Clic sur le bouton "Voir les candidatures"
    $('#offers #displayPosts #openPosts').click(function() {
        var idOffer = KeepNumber($('.offer.active').attr('id'));
		
        $.post(
            'models/getPosts.php',
            {
                    idOffer : idOffer
            },
            function (data) {
                $('#posts tbody').html('');
                
                $.each(data, function(key, value) {
                    var post = value['Post'];
                    var webUser = value['WebUser'];
                    var html;
                    html  = '<tr id="post' + post['Identifier'] + '" class="post">';
                    html +=     '<td>' + EmptyIfUndefined(webUser['Firstname']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(webUser['Lastname']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(webUser['Address']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(webUser['City']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(webUser['PhoneNumber']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(post['DatePost']) + '</td>';
                    html += '</tr>';

                    $('#posts tbody').append(html);
                    InitializePost();
                });

                $('#postsModal').modal('show');
            },
            'json'
        ).fail(function(data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        });
    });
}

function InitializeDisplayPostDetails() {
	// Clic sur le bouton "Plus de détails"
    $('#posts #displayDetails button').click(function() {
        var idPost = KeepNumber($('.post.active').attr('id'));
		
		$.post(
			'models/getPostDetails.php',
			{
				idPost : idPost
			},
			function (data) {
				var html;
                var datePost =  data['DatePost'].split('-');
                var year  = datePost[0];
                var month = datePost[1];
                var day   = datePost[2];
                
				var link = {Letter:'#', CV:'#'};
				var disabled = {Letter:' disabled', CV:' disabled'};
				
				if (data['Letter'] != '') {
					link['Letter'] = '/documents/' + data['Letter'];
					disabled['Letter'] = '';
				}
				if (data['CV'] != '') {
					link['CV'] = '/documents/' + data['CV'];
					disabled['CV'] = '';
				}
				
				html  = '<h4>' + data['Firstname'] + ' ' + data['Lastname'] + '</h4>';
				html +=	'<p>';
				html +=		'<b>Email :</b>' 		+ data['Email'] 	+ '<br />';
				html +=		'<b>Adresse :</b>' 		+ data['Address'] 	+ '<br />';
				html +=		'<b>Ville :</b>' 		+ data['City'] 		+ '<br />';
				html +=		'<b>Code postal :</b>' 	+ data['ZipCode']
				html +=	'</p>';
				html +=	'<div class="btn-group btn-group-justified" role="group">';
				html +=		'<a href="' + link['Letter'] + '" target="_blank" id="openLetter" class="btn btn-default' + disabled['Letter']  + '" role="button">Lettre de motivation</a>';
				html +=		'<a href="' + link['CV'] 	 + '" target="_blank" id="openCV" 	  class="btn btn-default' + disabled['CV'] 		+ '" role="button">CV</a>';
				html +=	'</div>';
				
				$('#postDetailsModal .modal-title').html('Candidature du ' + day + '/' + month + '/' +  year);
				$('#postDetailsModal .modal-body').html(html);
				
				$('#postsModal').modal('hide');
				$('#postDetailsModal').modal('show');
			},
			'json'
		);
    });
}

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
                
                if (offer['NumberViews'] >= 2) {
                    $('#detailsModal #numberViews').html(offer['NumberViews'] + ' vues');
                } else {
                    $('#detailsModal #numberViews').html(offer['NumberViews'] + ' vue');
                }
                
                latitude = offer['Latitude'].trim();
                longitude = offer['Longitude'].trim();
                                
                $('#errorMap').remove();
                $('#map').hide();
                if (latitude == '' || longitude == '') {
                    $('#mapContainer').prepend('<div class="alert alert-warning" role="alert" id="errorMap">Adresse non trouvée</div>');
                }
                
                $('#detailsModal').modal('show');
            },
            'json'
        ).fail(function(data) {
            $('#error').remove();
            $('body').append('<div id="error">' + data['responseText'] + '</div>');
        });
    });
}