$(function() {
	WindowResize();
	
	$(window).resize(function() {
		WindowResize();
		console.log($('body').width());
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

// Fonction renvoyant une chaine vide si le parametre est indéfini
function EmptyIfUndefined(str) {
    if (typeof str == 'undefined') {
        return '';
    }
    return str;
}

// Fonction adaptant la taille du menu
function WindowResize() {
	if ($('body').width() <= 1000) {
		$('header .nav .col-sm-7').addClass('col-sm-9');
		$('header .nav .col-sm-7').removeClass('col-sm-7');
		$('header .nav .col-sm-10').addClass('col-sm-12');
		$('header .nav .col-sm-10').removeClass('col-sm-10');
	} else {
		$('header .nav .col-sm-9').addClass('col-sm-7');
		$('header .nav .col-sm-9').removeClass('col-sm-9');
		$('header .nav .col-sm-12').addClass('col-sm-10');
		$('header .nav .col-sm-12').removeClass('col-sm-12');
	}
	
	if ($('body').width() <= 768) {
		$('header .header .row .col-sm-3').insertBefore('header .header .row .col-sm-9');
		$('#account').insertAfter('header .header h1');
	} else {
		$('header .header .row .col-sm-3').insertAfter('header .header .row .col-sm-9');
	}
}