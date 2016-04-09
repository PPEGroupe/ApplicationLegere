<?php require 'ClassesLoader.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Tests Connexion -----------------------------------
if (!empty($_POST))
{
    // Instancie les managers
    $accountManager  = new AccountManager($db);
    $clientManager   = new ClientManager($db);
    $webUserManager  = new WebUserManager($db);
    $partnerManager  = new PartnerManager($db);
    
    // Récupère de la vue
    $email    = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    
    // Fait les test sur l'email
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
            // Met à jour la session
            $_SESSION['account'] = $account;
            
            // Récupère de la BDD par comptes grace aux Identifiants
            $_SESSION['client']  = $clientManager->GetByAccount($account->Identifier());
            $_SESSION['partner'] = $partnerManager->GetByAccount($account->Identifier());
            $_SESSION['webUser'] = $webUserManager->GetByAccount($account->Identifier());
            
            // Vérifie la connexion
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
                $error[] = 'Vous n\' êtes pas connu du site, inscrivez-vous :)';
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