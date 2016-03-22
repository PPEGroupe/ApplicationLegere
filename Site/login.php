<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Tests Connexion -----------------------------------
if (isset ($_POST['sendConnection']))
{
    $clientManager = new ClientManager($db);
    $email         = trim($_POST['emailConnection']);
    $password      = trim($_POST['passwordConnection']);
  
    if ( $email == '' || $password == '')
    {
        $errorConnection = 'Veuillez remplir tous les champs';
    } 
    else if (strlen($email) < 3 ) 
    {
        $errorConnection = 'L\'email est composé de plus de 3 caractères!';
    }
    else if (strlen($password) < 4)
    {
        $errorConnection = 'Le mot de passe est composé de plus de 4 caractères!';
    }
//    else if (preg_match($regexPassword, $password) == 0)
//    {
//        $errorConnection = 'Le mot de passe n\'est pas correct';
//    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $errorRegister = 'Veuillez remplir un e-mail valide';
    }
    else
    {
        $client = $clientManager->GetAccount($email, $password);
        
        if ($client != null)
        {
            $_SESSION['account'] = $client;
        }
        else
        {
            $errorConnection = 'Vous n\' êtes pas connu du site, inscrivez-vous :)';
        }
    }
}

//----------------------------------- Tests Inscription -----------------------------------

if (isset ($_POST['sendRegister']))
{
    $clientManager        = new ClientManager($db);
    $company              = trim($_POST['companyRegister']);
    $email                = trim($_POST['emailRegister']);
    $password             = trim($_POST['passwordRegister']);
    $passwordConfirmation = trim($_POST['passwordConfirmationRegister']);
    
    if ($email == '' || $password == '' || $passwordConfirmation == '' || $company == '' )
    {
        $errorRegister = 'Veuillez remplir tous les champs';
    } 
   else if (strlen($email) < 3 ) 
    {
        $errorRegister = 'L\'email est composé de plus de 3 caractères!';
    }
    else if (strlen($password) < 4)
    {
        $errorRegister = 'Le mot de passe est composé de plus de 4 caractères!';
    }
//    else if (preg_match($regexPassword, $password) == 0)
//    {
//        $errorRegister = 'Le mot de passe n\'est pas conforme aux exigenences!'
//        . '</br>Il doit avoir au moin 6 caractères'
//        . '</br>Il doit comporter au moin une majuscule'
//        . '</br>Il doit comporter au moin un chiffe.';
//    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $errorRegister = 'Veuillez remplir un e-mail valide';
    }
    else if ($clientManager->Exist($email))
    {
         $errorRegister = 'Cet Identifiant existe déjà!';
    }
    else
    {
        $client = new Client(); 
        $client->setCompany($company);
        $client->setEmail($email);
        $client->setPassword($password);
        
        $clientManager->Add($client);
    }
} 

if (isset($_SESSION['account']))
{
    $offerManager = new OfferManager($db);
    $client = $_SESSION['account'];
	$numberOfferClient = $offerManager->CountByClient($client->Identifier());
}

//------ Inclut la vue html ------
require '/views/view-login.php';

?>