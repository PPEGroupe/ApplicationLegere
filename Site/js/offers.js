$(function(){
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #postulate').remove();
        
        var html;
        html  = '<tr id="displayPosts">';
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
		
		$('#posts tbody').html('<tr class="warning"><td colspan="6">Chargement</td></tr>');
		
		$.post(
			'models/getPosts.php',
			{
				idOffer : idOffer
			},
			function (data) {
				console.info(data);
			},
			'json'
		);
    });
});