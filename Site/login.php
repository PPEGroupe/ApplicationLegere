<?php 
require 'models/ClassesLoader.php';

//----------------------------------- Tests Connexion -----------------------------------
if (isset ($_POST['sendConnection']))
{
    $email     = trim($_POST['emailConnection']);
    $password  = trim($_POST['passwordConnection']);
    $regex     = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#';
    
    if ( $email == '' || $password == '')
    {
        $errorConnection = 'Veuillez remplir tous les champs';
    } 
    else if (strlen($email) < 3 ) 
    {
        $errorConnection = 'Ce champs est composé de plus de 3 caractères!';
    }
    else if (strlen($password) < 4)
    {
        $errorConnection = 'Ce champs est composé de plus de 4 caractères!';
    }
    /*else if (preg_match($regex, $password) == 0)
    {
        $errorConnection = 'Le mot de passe n\'est pas conforme aux exigenences!';
    }*/
    else
    {
        $clientManager = new ClientManager($db);
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
    $email                = trim($_POST['emailRegister']);
    $password             = trim($_POST['passwordRegister']);
    $passwordConfirmation = trim($_POST['passwordConfirmationRegister']);
    
    $regex                = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#';
    
    if ($email == '' || $password == '' || $passwordConfirmation == '' )
    {
        $errorRegister = 'Veuillez remplir tous les champs';
    } 
    if ($email == '' || $password == '' || $passwordConfirmation == '' )
    {
        $errorRegister = 'Veuillez remplir tous les champs';
    } 
    else
    {
        $client = new Client($db); 
        $clientManager = new ClientManager($db);
        $clientManager->Add($client);
    }
} 


//------ Inclut la vue html ------
require '/views/view-login.php';

?>