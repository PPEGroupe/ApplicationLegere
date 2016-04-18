<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
	$offerManager          = new OfferManager($db);
	$clientManager         = new ClientManager($db);
	$typeOfContractManager = new TypeOfContractManager($db);
    
    // Récupère l'offre avec l'identifiant envoyé par la requète AJAX, le client qui a créé l'offre et le type de contrat de l'offre
	$offer          = $offerManager->Get($_POST['idOffer']);
    $client         = $clientManager->Get($offer->IdClient());
    $typeOfContract = $typeOfContractManager->Get($offer->IdTypeOfContract());
    
    echo '{"Offer":', $offer->ToJson(), ', "Client":', $client->ToJson(), ', "TypeOfContract":', $typeOfContract->ToJson(), '}';
}