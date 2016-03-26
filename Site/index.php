<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAll();

if (isset($_SESSION['account']))
{
    $client = $_SESSION['account'];
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
}

require '/views/view-index.php';