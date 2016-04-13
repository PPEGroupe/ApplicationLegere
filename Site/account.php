<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['connected']))
{
    $account = $_SESSION['account'];
    
    if ($_SESSION['connected'] == 'client')
    {
        $offerManager = new OfferManager($db);
        $client = $_SESSION['client'];
        $numberOfferClient = $offerManager->CountByClient($client->Identifier());
        require '/views/view-accountClient.php';
    }
    else if ($_SESSION['connected'] == 'partner')
    {
        $partner = $_SESSION['partner'];
        require '/views/view-accountPartner.php';
        
    }
    else if ($_SESSION['connected'] == 'webUser')
    {
        $postManager = new PostManager($db);
        $webUser = $_SESSION['webUser'];
        $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());
        require '/views/view-accountWebUser.php';
    }
}
else
{
    require '/views/view-denied.php';
}
?>

