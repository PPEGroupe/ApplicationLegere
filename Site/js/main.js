$(function () {
    // Fonction qui switch du compte connecté vers client
    $('#changeToClient').click(function () {
        $.post(
            'models/changeAccount.php',
            {
                target : 'client'
            },
            function () {
                location.reload();
            }
        )
    });
    
    // Fonction qui switch du compte connecté vers partenaire
    $('#changeToPartner').click(function () {
        $.post(
            'models/changeAccount.php',
            {
                target : 'partner'
            },
            function () {
                location.reload();
            }
        )
    });
    
    // Fonction qui switch du compte connecté vers l'intenaute
    $('#changeToWebUser').click(function () {
        $.post(
            'models/changeAccount.php',
            {
                target : 'webUser'
            },
            function () {
                location.reload();
            }
        )
    });
})

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

// Fonction renvoyant une date au format jj/mm/aaaa
function DateFormat(date) {
	var datePost =  date.split('-');
    
	if (datePost != '') {
		var year  = datePost[0];
		var month = datePost[1];
		var day   = datePost[2];
	
		return day + '/' + month + '/' + year;
	}
	return '';
}