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
    $offerList = $offerManager->GetAllFromPublication();    
}

if (isset($_SESSION['client']))
{
    $client = $_SESSION['client'];
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
}
else if (isset($_SESSION['webUser']))
{
    $postManager = new PostManager($db);
    $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());
}

require '/views/view-index.php';