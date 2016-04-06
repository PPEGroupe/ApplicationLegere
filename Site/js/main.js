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
