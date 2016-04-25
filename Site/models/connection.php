<?php 

require 'ClassesLoader.php';
require 'page.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST))
{
    $accountManager  = new AccountManager($db);
    $clientManager   = new ClientManager($db);
    $webUserManager  = new WebUserManager($db);
    $partnerManager  = new PartnerManager($db);
    
    $email    = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    
    if (empty($_POST['email']) || empty($_POST['password']) )
    {
        $error[] = 'Veuillez remplir tous les champs';
    } 
    else if (strlen($email) < 3 ) 
    {
        $error[] = 'Veuillez remplir un e-mail valide';
    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $error[] = 'Veuillez remplir un e-mail valide';
    }
    else
    {
        $account = $accountManager->GetAccount($email, $password);

        if ($account != null)
        {
            $_SESSION['account'] = $account;
            
            // Récupère le client, partenaire et internaute liés au compte.
            $_SESSION['client']  = $clientManager->GetByAccount($account->Identifier());
            $_SESSION['partner'] = $partnerManager->GetByAccount($account->Identifier());
            $_SESSION['webUser'] = $webUserManager->GetByAccount($account->Identifier());
            
            // Modifie le compte sélectionné.
            if ($_SESSION['client'] != null) 
            {
                $_SESSION['connected'] = 'client';
            }
            else if ($_SESSION['partner'] != null) 
            {
                $_SESSION['connected'] = 'partner';
            }
            else if ($_SESSION['webUser'] != null) 
            {
                $_SESSION['connected'] = 'webUser';
            }
            else 
            {
                $error[] = 'Vous n\'êtes pas connu du site, inscrivez-vous :)';
            }
        }
        else
        {
            $error[] = 'Vous n\' êtes pas connu du site, inscrivez-vous :)';
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