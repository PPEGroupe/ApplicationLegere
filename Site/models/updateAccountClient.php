<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    // Vérifie l'existance des sessions 'account', 'client' et 'connected' et vérifie que le compte sélectionné est 'client'.
    if (isset($_SESSION['account']) && isset($_SESSION['client']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'client')
    {
        $clientManager  = new ClientManager($db);
        $accountManager = new AccountManager($db);
        
        $account = $_SESSION['account'];
        $client  = $_SESSION['client'];
        
        $company      = trim($_POST['company']);
        $email        = trim($_POST['email']);
        $phoneNumber  = trim($_POST['phoneNumber']);
        $fax          = trim($_POST['fax']);
        $url          = trim($_POST['url']);
        $address      = trim($_POST['address']);
        $city         = trim($_POST['city']);
        $zipCode      = trim($_POST['zipCode']);
        
        if (empty($email) || empty($company))
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
            $client->setCompany($company);
            $client->setPhoneNumber($phoneNumber);
            $client->setFax($fax);
            $client->setUrl($url);
            $client->setAddress($address);
            $client->setCity($city);
            $client->setZipCode($zipCode);
            
            // Met à jour la BDD
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