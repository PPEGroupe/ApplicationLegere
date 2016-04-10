<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';


//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['emailClient']) || empty($_POST['passwordClient']) || empty($_POST['passwordConfirmationClient']) || empty($_POST['companyClient']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $clientManager        = new ClientManager($db);
        
        $company              = trim($_POST['companyClient']);
        $email                = trim($_POST['emailClient']);
        $password             = trim($_POST['passwordClient']);
        $passwordConfirmation = trim($_POST['passwordConfirmationClient']);
        
        if (strlen($email) < 3 || preg_match($regexEmail, $email) == 0) 
        {
            $error[] = 'L\'email est composé de plus de 3 caractères!';
        }
        else if (strlen($password) < 6)
        {
            $error[] = 'Veuillez renseigner un mot de passe de plus de 6 caractères!';
        }
        else if (preg_match($regexPassword, $password) == 0)
        {
            $error[] = 'Veuillez renseigner un mot de passe valide!
                        Il doit contenir au moins 6 caractères dont une lettre et un chiffre';
        }
        else if ($password != $passwordConfirmation)
        {
            $error[] = 'Les mots de passe ne correspondent pas!';
        }
        else if ($clientManager->Exist($email))
        {
             $error[] = 'Cet identifiant existe déjà!';
        }
        else
        {
            $client = new Client(); 
            $client->setCompany($company);
            $client->setEmail($email);
            $client->setPassword(md5($password));

            $clientManager->Add($client);
        }
    }
    
    if (isset($error))
    {
        echo json_encode($error);
    }
    else
    {
        echo json_encode('success');
    }
} 