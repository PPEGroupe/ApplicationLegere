$(function(){
    $('.offer').click(function() {
        $('.offer.active').removeClass('active'); // Désélectionne l'ancienne ligne
        $(this).addClass('active'); // Sélectionne la ligne
        
        $('#offers #postulate').remove();
        
        var html;
        html  = '<tr id="postulate">';
        html +=     '<td colspan="6">';
        html +=         '<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postulateModal">Postuler</button>';
        html +=     '</td>';
        html += '</tr>';
        $(this).after(html);
    });
});

// Fonction supprimant les lettre d'une chaine (utilisée pour garder l'identifiant d'un id)
function KeepNumber(str) {
    var again = /[a-zA-Z]/.test(str);
    while (again) {
        str = str.replace(/[a-zA-Z]/g, '');
        again = /[a-zA-Z]/.test(str);
    }
    return str;
}

$.fn.extend({
	findPos : function() {
		obj = jQuery(this).get(0);
		var curleft = obj.offsetLeft || 0;
		var curtop = obj.offsetTop || 0;
		while (obj = obj.offsetParent) {
			curleft += obj.offsetLeft
			curtop += obj.offsetTop
		}
		return {x:curleft, y:curtop};
	}
});