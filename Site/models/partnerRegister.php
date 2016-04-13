<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';


//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']) || empty($_POST['url']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $partnerManager       = new PartnerManager($db);
        $accountManager       = new AccountManager($db);
        
        $email                = trim($_POST['email']);
        $url                  = trim($_POST['url']);
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
            if (isset($_SESSION['account']) && $_SESSION['account']->Email() == $email)
            {
                if ($_SESSION['account']->Password() == $password) 
                {
                    $partnerManager->Add($_SESSION['account']);
                }
                else
                {
                    $error[] = 'Mot de passe éronné pour cet identifiant!';
                }
            }
            else 
            {
                $error[] = 'Cet identifiant existe déjà!';
            }
        }
        else
        {
            $account = new Account();
            $partner = new Partner();
            
            $account->setEmail($email);
            $account->setPassword($password);
            $accountManager->Add($account);

            $account = $accountManager->GetAccount($email, $password);
            
            $partner->setIdAccount($account->Identifier());
            $partner->setURL($url);
            
            if ($account != null && $partner != null)
            {
                $partnerManager->Add($partner);
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