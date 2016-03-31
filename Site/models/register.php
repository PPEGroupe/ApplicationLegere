<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';


//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']) || empty($_POST['company']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $clientManager        = new ClientManager($db);
        $company              = trim($_POST['company']);
        $email                = trim($_POST['email']);
        $password             = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['passwordConfirmation']);
        
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
            $client->setPassword($password);

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