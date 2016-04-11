<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
    $offerManager = new OfferManager($db);
	$offer = $offerManager->Get($_POST['idOffer']);
    
    // Incrémente la nombre de vues de l'offre
    $offer->AddView();
    $offerManager->AddView($offer);
}