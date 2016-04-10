<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';


//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $accountManager       = new AccountManager($db);
        $webUserManager       = new WebUserManager($db);
        
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
        else if ($accountManager->EmailExists($email))
        {
             $error[] = 'Cet identifiant existe déjà!';
        }
        else
        {
            $account = new Account();
            $webUser = new WebUser();
            
            $account->setEmail($email);
            $account->setPassword(md5($password));
            $accountManager->Add($account);
            
            $account = $accountManager->GetAccountId($email, $password);
            $webUser->setIdAccount($account->Identifier());
            $webUserManager->Add($webUser);
             
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