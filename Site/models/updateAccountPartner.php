<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    // Vérifie l'existance des sessions 'account', 'partner' et 'connected' et vérifie que le compte sélectionné est 'partner'.
    if (isset($_SESSION['account']) && isset($_SESSION['partner']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'partner')
    {
        $partnerManager = new PartnerManager($db);
        $accountManager = new AccountManager($db);
        
        $account = $_SESSION['account'];
        $partner = $_SESSION['partner'];
        
        $email = trim($_POST['email']);
        $url   = trim($_POST['url']);
        
        if (empty($email))
        {
            $error[] = 'Veuillez remplir les champs obligatoires.';
        }   
        else 
        {    
            if (strlen($email) < 3 || preg_match($regexEmail, $email) == 0) 
            {
                $error[] =  'Veuillez remplir un email valide.';
            }
        }
        if (!isset($error))
        {
            // Modifie les champs
            $account->setEmail($email);
            $partner->setURL($url);
            
            // Met à jour la BDD
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