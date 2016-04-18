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
    }
    else if ($_SESSION['connected'] == 'webUser')
    {
        $postManager = new PostManager($db);
        $webUser = $_SESSION['webUser'];
        $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());
    }
}

require '/views/view-login.php';

