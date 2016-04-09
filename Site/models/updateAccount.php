<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (isset($_SESSION['account']))
    {
        $accountManager = new AccountManager($db);
        
        
        $account = $accountManager->Get($_SESSION['account']->Identifier());
        $account->Initialize($_POST);
        
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
            
            $account->setCompany($company);
            $account->setIdentifier($_SESSION['account']->Identifier());
            $account->setEmail($email);
            $account->setPhoneNumber($phoneNumber);
            $account->setFax($fax);
            $account->setUrl($url);
            $account->setAddress($address);
            $account->setCity($city);
            $account->setZipCode($zipCode);
            
            $accountManager->Update($account);
            $_SESSION['account'] = $account;
            
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