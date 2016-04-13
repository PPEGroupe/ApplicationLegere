<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    // Vérifie l'existance des sessions / et la connexion des users
    if (isset($_SESSION['account']) && isset($_SESSION['partner']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'partner')
    {
        // Instancie les managers
        $partnerManager  = new PartnerManager($db);
        $accountManager = new AccountManager($db);
        
        //Récupère en session
        $account = $_SESSION['account'];
        $partner = $_SESSION['partner'];
        
        var_dump($partner);
        //Récupère de la vue
        $email = trim($_POST['email']);
        $url   = trim($_POST['url']);
        var_dump($url);
        
        // Fait les test sur l'email
        if (empty($email))
        {
            $error[] = 'Veuillez remplir les champs obligatoires.';
        }   
        else 
        {    
            if (strlen($email) < 3 ) 
            {
                $error[] = 'L\'email est composé de plus de 3 caractères!';
            }
            else if (preg_match($regexEmail, $email) == 0)
            {
                $error[] =  'Veuillez remplir un e-mail valide.';
            }
        }
        if (!isset($error))
        {
            // Modifie les champs
            $account->setEmail($email);
            $partner->setURL($url);
            
            // Met à jour la BDD par clientManager
            $partnerManager->Update($partner);
            $accountManager->Update($account);
            
            // Met à jour la session
            $_SESSION['account'] = $account;
            $_SESSION['$partner'] = $partner;
            
            echo json_encode('success');
        }
        else
        {
            echo json_encode($error);
        }
    }
}
?>