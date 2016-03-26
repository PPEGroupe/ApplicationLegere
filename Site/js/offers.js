$(function(){
	// Séléction d'une offre
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #displayPosts').remove();
        
        var html;
        html  = '<tr id="displayPosts" class="toSelect">';
        html +=     '<td colspan="5">';
        html +=         '<button class="btn btn-warning btn-lg">';
        html +=             'Voir les candidatures <span class="label label-warning">' + $(this).children('.hidden').html() + '</span>';
        html +=         '</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
		
		InitializeDisplayPosts();
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
		
		InitializeDisplayDetails();
    });
}

function InitializeDisplayPosts() {
	// Clic sur le bouton "Voir les candidatures"
    $('#offers #displayPosts button').click(function() {
        var idOffer = KeepNumber($('.offer.active').attr('id'));
		
		$.post(
			'models/getPosts.php',
			{
				idOffer : idOffer
			},
			function (data) {
                $('#posts tbody').html('');
                
				$.each(data, function(key, value) {
                    var html;
                    html  = '<tr id="post' + value['Identifier'] + '" class="post">';
                    html +=     '<td>' + EmptyIfUndefined(value['Firstname']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['Lastname']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['Address']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['City']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['NumberPhone']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['Email']) + '</td>';
                    html +=     '<td>' + EmptyIfUndefined(value['DatePost']) + '</td>';
                    html += '</tr>';
                    
                    $('#posts tbody').append(html);
                    InitializePost();
                });
				
				$('#postsModal').modal('show');
			},
			'json'
		);
    });
}

function InitializeDisplayDetails() {
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