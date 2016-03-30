<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (isset($_SESSION['account']))
    {
        $clientManager = new ClientManager($db);
        
        
        $client = $clientManager->Get($_SESSION['account']->Identifier());
        $client->Initialize($_POST);
        
        $company              = trim($_POST['company']);
        $email                = trim($_POST['email']);
        $phoneNumber          = trim($_POST['phoneNumber']);
        $fax                  = trim($_POST['fax']);
        $url                  = trim($_POST['url']);
        $address              = trim($_POST['address']);
        $city                 = trim($_POST['city']);
        $zipCode              = trim($_POST['zipCode']);
        
        
        
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
            
            $client->setCompany($company);
            $client->setIdentifier($_SESSION['account']->Identifier());
            $client->setEmail($email);
            $client->setPhoneNumber($phoneNumber);
            $client->setFax($fax);
            $client->setUrl($url);
            $client->setAddress($address);
            $client->setCity($city);
            $client->setZipCode($zipCode);
            
            $clientManager->Update($client);
            $_SESSION['account'] = $client;
            
            echo json_encode('success');
            //header("Refresh:0; url=account.php");  // à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
        }
        else
        {
            echo json_encode($error);
            //header("Refresh:0; url=account.php");// à supprimer apres la résolution de prob (lien entre account.js et account.php "Notify") RB.
        }
    }
}
?>