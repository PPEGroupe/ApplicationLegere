$(function(){
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #displayPosts').remove();
        
        var html;
        html  = '<tr id="displayPosts" class="toSelect">';
        html +=     '<td colspan="5">';
        html +=         '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postsModal">';
        html +=             'Voir les candidatures <span class="label label-warning">' + $(this).children('.hidden').html() + '</span>';
        html +=         '</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    });
	
	$('#postsModal').on('shown.bs.modal', function () {
        var idOffer = KeepNumber($('.offer.active').attr('id'));
		
		$.post(
			'models/getPosts.php',
			{
				idOffer : idOffer
			},
			function (data) {
                $('#posts tbody').html('');
                
				$.each(data['posts'], function(key, value) {
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
			},
			'json'
		);
    });
});

function InitializePost() {
    $('.post').click(function() {
        $('.posts.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#posts #displayDetails').remove();
        
        var html;
        html  = '<tr id="displayDetails" class="toSelect">';
        html +=     '<td colspan="7">';
        html +=         '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#detailsModal">';
        html +=             'Plus de détails';
        html +=         '</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    });
}