<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['account']))
{
    $offerManager = new OfferManager($db);
    $client = $_SESSION['account'];
	$numberOfferClient = $offerManager->CountByClient($client->Identifier());
}

if (isset($_GET['error']))
{
	$errorTitle = 'Erreur '. $_GET['error']. ' !';
	$errorDescription;

	switch($_GET['error'])
	{
	   case '400':
			$errorDescription = 'Échec de l\'analyse HTTP.';
			break;
	   case '401':
			$errorDescription = 'Le pseudo ou le mot de passe n\'est pas correct !';
			break;
	   case '402':
			$errorDescription = 'Le client doit reformuler sa demande avec les bonnes données de paiement.';
			break;
	   case '403':
			$errorDescription = 'Requête interdite !';
			break;
	   case '404':
			$errorDescription = 'La page est innexistante !';
			break;
	   case '405':
			$errorDescription = 'Méthode non autorisée.';
			break;
	   case '500':
			$errorDescription = 'Erreur interne au serveur ou serveur saturé.';
			break;
	   case '501':
			$errorDescription = 'Le serveur ne supporte pas le service demandé.';
			break;
	   case '502':
			$errorDescription = 'Mauvaise passerelle.';
			break;
	   case '503':
			$errorDescription = 'Service indisponible.';
			break;
	   case '504':
			$errorDescription = 'Trop de temps à la réponse.';
			break;
	   case '505':
			$errorDescription = 'Version HTTP non supportée.';
			break;
	   default:
			$errorTitle = 'Erreur !';
			$errorDescription = 'Une erreur s\'est produite.';
	}
}
else
{
	$errorTitle = 'Erreur !';
	$errorDescription = 'Une erreur s\'est produite.';
}

require '/views/view-error.php';
