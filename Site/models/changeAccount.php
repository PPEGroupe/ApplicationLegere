<?php require 'ClassesLoader.php';

if (!empty($_POST) && isset($_POST['target']))
{
    $target = $_POST['target'];
    
    // Si $target est égale à 'client', 'partner' ou 'webUser'
    // Modifie le compte de connexion sélectionné
    if (in_array($target, array('client', 'partner', 'webUser')))
    {
        $_SESSION['connected'] = $target;
    }
}