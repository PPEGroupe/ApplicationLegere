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

$firstname   = '';
$lastname    = '';
$email       = '';
$phoneNumber = '';
$address     = '';
$city        = '';
$zipCode     = '';

if (isset($_SESSION['account']))
{
    $account = $_SESSION['account'];
    
    if (isset($_SESSION['client']))
    {
        $client = $_SESSION['client'];
        $numberOfferClient = $offerManager->CountByClient($client->Identifier());
    }

    if (isset($_SESSION['webUser']))
    {
        $postManager = new PostManager($db);
        $webUser = $_SESSION['webUser'];
        $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());

        $firstname   = $webUser->Firstname();
        $lastname    = $webUser->Lastname();
        $email       = $account->Email();
        $phoneNumber = $webUser->PhoneNumber();
        $address     = $webUser->Address();
        $city        = $webUser->City();
        $zipCode     = $webUser->ZipCode();
    }
}

require '/views/view-index.php';
