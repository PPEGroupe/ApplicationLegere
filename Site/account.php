<?php 
require 'models/ClassesLoader.php';
require 'models/page.php';

if (isset($_SESSION['connected']))
{
    // Récupère de la session
    $account = $_SESSION['account'];
    
    // Si connecté en tant que client
    if ($_SESSION['connected'] == 'client')
    {
        $offerManager = new OfferManager($db);
        $client = $_SESSION['client'];
        $numberOfferClient = $offerManager->CountByClient($client->Identifier());
        require 'views/view-accountClient.php';
    }
    // Si connecté en tant que partenaire
    else if ($_SESSION['connected'] == 'partner')
    {
        $partner = $_SESSION['partner'];
        require 'views/view-accountPartner.php';
        
    }
    // Si connecté en tant que internaute
    else if ($_SESSION['connected'] == 'webUser')
    {
        $postManager = new PostManager($db);
        $webUser = $_SESSION['webUser'];
        $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());
        require 'views/view-accountWebUser.php';
    }
}
else
{
    require 'views/view-denied.php';
}
?>

