<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['account']))
{
    $client = $_SESSION['account'];

    $offerManager = new OfferManager($db);
    $offerList = $offerManager->GetAllByClient($client->Identifier());

    require '/views/view-offers.php';

}