<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    // Vérifie l'existance des sessions 'account', 'webUser' et 'connected' et vérifie que le compte sélectionné est 'webUser'.
    if (isset($_SESSION['account']) && isset($_SESSION['webUser']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'webUser')
    {
        $webUserManager  = new ClientManager($db);
        $accountManager = new AccountManager($db);
        
        $account = $_SESSION['account'];
        $webUser = $_SESSION['webUser'];
        
        $email        = trim($_POST['email']);
        $firstname    = trim($_POST['firstname']);
        $lastname     = trim($_POST['lastname']);
        $phoneNumber  = trim($_POST['phoneNumber']);
        $address      = trim($_POST['address']);
        $city         = trim($_POST['city']);
        $zipCode      = trim($_POST['zipCode']);
        
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
            $webUser->setFirstName($firstname);
            $webUser->setLastName($lastname);
            $webUser->setPhoneNumber($phoneNumber);
            $webUser->setAddress($address);
            $webUser->setCity($city);
            $webUser->setZipCode($zipCode);
            
            // Met à jour la BDD
            $webUserManager->Update($webUser);
            $accountManager->Update($account);
            
            // Met à jour la session
            $_SESSION['account'] = $account;
            $_SESSION['$webUser'] = $webUser;
            
            echo json_encode('success');
        }
        else
        {
            echo json_encode($error);
        }
    }
}
?>