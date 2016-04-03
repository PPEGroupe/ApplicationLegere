<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['account']))
{
    $client = $_SESSION['account'];

    $offerManager = new OfferManager($db);
    $postManager = new PostManager($db);
    $offerList = $offerManager->GetAllByClient($client->Identifier());
	$numberOfferClient = $offerManager->CountByClient($client->Identifier());
	
    require '/views/view-offers.php';
}
else
{
    require '/views/view-denied.php';
}