<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';


//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['emailPartner']) || empty($_POST['passwordPartner']) || empty($_POST['passwordConfirmationPartner']) || empty($_POST['urlPartner']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $partnerManager       = new PartnerManager($db);
        
        $email                = trim($_POST['emailPartner']);
        $url                  = trim($_POST['urlPartner']);
        $password             = trim($_POST['passwordPartner']);
        $passwordConfirmation = trim($_POST['passwordConfirmationPartner']);
        
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
//        else if ($partnerManager->Exist($email))
//        {
//             $error[] = 'Cet identifiant existe déjà!';
//        }
        else
        {
            $partner = new Partner(); 
            $partner->setEmail($email);
            $partner->setPassword(md5($password));

            $partnerManager->Add($partner);
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