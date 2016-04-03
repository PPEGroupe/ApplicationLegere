<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['account']))
{
    $offerManager = new OfferManager($db);
    $client = $_SESSION['account'];
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
    
    if (get_class($_SESSION['account']) == 'Client')
    {
        require '/views/view-accountClient.php';
    }
    else
    {
        require '/views/view-accountPartner.php';
    }
}
else
{
    require '/views/view-denied.php';
}
?>

