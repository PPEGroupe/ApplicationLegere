<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

$offerManager = new OfferManager($db);

$keyword = '';
// Moteur de recherche
if (isset($_POST['search']) && !empty($_POST['searchText']))
{
    $keyword = $_POST['searchText'];
    $offerList = $offerManager->SearchOffer($keyword);
}
else
{
    $offerList = $offerManager->GetAll();    
}

if (isset($_SESSION['account']))
{
    $client = $_SESSION['account'];
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
}


require '/views/view-index.php';