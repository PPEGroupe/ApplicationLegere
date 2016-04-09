<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
// Vérifie l'existance des sessions / et la connexion des users
    if (isset($_SESSION['account']) && isset($_SESSION['client']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'client')
    {
        // Instancie les managers
        $clientManager  = new ClientManager($db);
        $accountManager = new AccountManager($db);
        
        // Récupère en session
        $account = $_SESSION['account'];
        $client  = $_SESSION['client'];
        
        // Récupère de la vue
        $company      = trim($_POST['company']);
        $email        = trim($_POST['email']);
        $phoneNumber  = trim($_POST['phoneNumber']);
        $fax          = trim($_POST['fax']);
        $url          = trim($_POST['url']);
        $address      = trim($_POST['address']);
        $city         = trim($_POST['city']);
        $zipCode      = trim($_POST['zipCode']);
        
        
        // Fait les test sur l'email
        if (empty($email) || empty($company))
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
            $client->setCompany($company);
            $account->setEmail($email);
            $client->setPhoneNumber($phoneNumber);
            $client->setFax($fax);
            $client->setUrl($url);
            $client->setAddress($address);
            $client->setCity($city);
            $client->setZipCode($zipCode);
            
            // Met à jour la BDD par le Manager
            $clientManager->Update($client);
            $accountManager->Update($account);
            
            // Met à jour la session
            $_SESSION['account'] = $account;
            $_SESSION['client'] = $client;
            
            echo json_encode('success');
        }
        else
        {
            echo json_encode($error);
        }
    }
}
?>