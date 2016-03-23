<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';


$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Modification -----------------------------------

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
        $errorRegister = 'Le mot de passe est composé de moins de 4 caractères!';
    }
    else if (preg_match($regexPassword, $password) == 0)
    {
        $errorRegister = 'Le mot de passe n\'est pas conforme aux exigenences!'
        . '</br><ul>Il doit avoir au moin 6 caractères</ul>'
        . '<ul>Il doit comporter au moin une majuscule</ul>'
        . '<ul>Il doit comporter au moin un chiffe.';
    }
    else if ($password != $passwordConfirmation)
    {
        $errorRegister = 'les deux mots de passe ne sont pas identique.';
    }
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
        
        $clientManager->Update($client);
    }
} 

//------ Inclut la vue html ------
require '/views/view-account.php';

?>