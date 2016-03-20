<?php 

//----------------------------------- Tests Connexion -----------------------------------
if (isset ($_POST['sendConnection']))
{
    $identifier         = trim($_POST['identifierConnection']);
    $password           = trim($_POST['passwordConnection']);
    $regex              = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#';
    
    if ( $identifier == '' || $password == '')
    {
        $errorConnection = 'Veuillez remplir tous les champs';
    } 
    else if (strlen($identifier) < 3 || strlen($password) < 6) 
    {
        echo 'rerer';
        $errorConnection = 'Ce champs est composé de plus de 3 caractères!';
    }
    else if (preg_match($regex, $password) == 0)
    {
        $errorConnection = 'Le mot de passe n\'est pas conforme aux exigenences!';
    }
    else
    {
        $clientManager = new clientManager($db);
        $account = $clientManager->GetAccount($identifiant, $password);
        $_SESSION['account'] = $account;
    }
}

//----------------------------------- Tests Inscription -----------------------------------
if (isset ($_POST['sendRegister']))
{
    $identifier           = trim($_POST['identifierConnection']);
    $password             = trim($_POST['passwordConnection']);
    $passwordConfirmation = trim($_POST['passwordConfirmationRegister']);
    $regex                = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#';
    
    if ($identifier == '' || $password == '' || $passwordConfirmation == '' )
    {
        $errorRegister = 'Veuillez remplir tous les champs';
    } 
    else
    {
        $clientManager = new clientManager($db);
        $account = $clientManager->Add($url, $identifier, $phoneNumber, $fax, $address, $company)
    }
}
:URL',         
:Email',       
:PhoneNumber', 
:Fax',         
:Address',     
:Address',     
:Company',     


//------ Inclut la vue html ------
require '/views/view-login.php';

?>