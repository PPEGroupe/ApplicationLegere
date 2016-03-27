<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['account']))
{
    $offerManager = new OfferManager($db);
    $clientManager = new ClientManager($db);
    
     
    $client = $clientManager->Get($_SESSION['account']->Identifier());
    $client->Initialize($_POST);
    
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
    
 
}
    
$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Modification des information -----------------------------------

if (isset ($_POST['sendPostInfo']))
{
    
    $clientManager        = new ClientManager($db);
    $company              = trim($_POST['companyRegister']);
    $email                = trim($_POST['emailRegister']);
    $phoneNumber          = trim($_POST['phoneNumberRegister']);
    $fax                  = trim($_POST['faxRegister']);
    $url                  = trim($_POST['urlRegister']);
    $address              = trim($_POST['addressRegister']);
    $city                 = trim($_POST['cityRegister']);
    $zipCode              = trim($_POST['zipCodeRegister']);

    
    
    if (empty($email) || empty($company))
    {
        $error[] = 'Veuillez remplir les champs obligatoires.';
    }   
    else 
    {    
        if (strlen($email) < 3 ) 
        {
            $error[] = 'L\'email est composé de plus de 3 caractères!';
        }
        else if (preg_match($regexEmail, $email) == 0)
        {
            $error[] =  'Veuillez remplir un e-mail valide.';
        }
    }
    if (!isset($error))
    {
    
        $client->setCompany($company);
        $client->setIdentifier($_SESSION['account']->Identifier());
        $client->setEmail($email);
        $client->setPhoneNumber($phoneNumber);
        $client->setFax($fax);
        $client->setUrl($url);
        $client->setAddress($address);
        $client->setCity($city);
        $client->setZipCode($zipCode);
        
        $clientManager->Update($client);
        $_SESSION['account'] = $client;
                
        echo json_encode('success');
        header("Refresh:0; url=account.php");  // à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
    }
    else
	{
        echo json_encode($error);
        header("Refresh:0; url=account.php");// à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
	}
        
       
    
} 

//----------------------------------- Modification de mot de passe -----------------------------------


if (isset ($_POST['sendPostPassword']))
{
    
    $clientManager              = new ClientManager($db);
    $oldPassword                = trim($_POST['oldPasswordRegister']);
    $newPassword                = trim($_POST['newPasswordRegister']);
    $confirmationPassword       = trim($_POST['passwordConfirmationRegister']);

    $passwordTest = $client->Password();
    $identifier = $_SESSION['account']->Identifier();
    
    
    if( empty($oldPassword) || empty($newPassword)  || empty($confirmationPassword) )
    {
         $error[] = 'Veuillez remplir tous les champs.';
        
    }
    else 
    {
        if ($oldPassword != $passwordTest)
        {
            $error[] = 'l\'ancien mot de passe est incorrect.';
        } 
        else if (strlen($newPassword) < 4 ) 
        {
            $error[] ='Le mot de passe est composé de plus de 4 caractères!';
        }
        else if (preg_match($regexPassword, $newPassword) == 0)
        {
            $error[] = 'Le mot de passe n\'est pas conforme aux exigenences!'
            . '</br>Il doit avoir au moin 6 caractères'
            . '</br>Il doit comporter au moin une majuscule'
            . '</br>Il doit comporter au moin un chiffe.';
        }
        else if ($newPassword != $confirmationPassword)
        {
            $error[] = 'Les deux nouveaux mots de passe ne sont pas identiques!';
        }
    }
    if(!isset($error))
    {
       
        $client->setPassword($newPassword);
        
        $clientManager->UpdatePassword($client);
        $_SESSION['account'] = $client;
        
        echo json_encode('success');
        header("Refresh:0; url=account.php");// à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
       
    }else
    {
        echo json_encode($error);
        header("Refresh:0; url=account.php");// à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
    }
} 


//------ Inclut la vue html ------
if (get_class($_SESSION['account']) == 'Client')
{
    require '/views/view-account.php';
}
else
{
    require '/views/view-accountPartner.php';
}

?>

