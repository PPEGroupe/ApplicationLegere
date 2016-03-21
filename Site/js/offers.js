$(function(){
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #postulate').remove();
        
        var html;
        html  = '<tr id="displayPosts">';
        html +=     '<td colspan="5">';
        html +=         '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postsModal">';
        html +=             'Voir les candidatures <span class="label label-warning">2</span>';
        html +=         '</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    });
});