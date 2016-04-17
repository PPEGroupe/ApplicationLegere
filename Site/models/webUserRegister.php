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
        $password             = md5(trim($_POST['password']));
        $passwordConfirmation = md5(trim($_POST['passwordConfirmation']));
        
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
            print_r($_SESSION);
            if (isset($_SESSION['account']) && $_SESSION['account']->Email() == $email)
            {
                if ($_SESSION['account']->Password() == $password) 
                {
                    $webUserManager->Add($_SESSION['account']);
                }
                else
                {
                    $error[] = 'Mot de passe éronné pour cet identifiant!';
                }
            }
            else 
            {
                $error[] = 'Ce compte utilisateur existe déjà!';
            }
        }
        else
        {
            $account = new Account();
            $webUser = new WebUser();
            
            $account->setEmail($email);
            $account->setPassword($password);
            $accountManager->Add($account);
            
            $account = $accountManager->GetAccount($email, $password);
            
            $webUser->setIdAccount($account->Identifier());
            
            if ($account != null)
            {
                $webUserManager->Add($webUser);
            } 
            else 
            {
                $error[] = 'L\'ajout n\'a pas fonctionné, merci de contacter le support!';
            }
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