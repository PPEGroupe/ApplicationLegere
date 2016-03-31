<?php

require 'ClassesLoader.php';
require 'page.php';

$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (isset($_SESSION['account']))
    {
        $partnerManager = new PartnerManager($db);
        
        
        $partner = $partnerManager->Get($_SESSION['account']->Identifier());
        $partner->Initialize($_POST);
        
        $email                = trim($_POST['email']);
        $url                  = trim($_POST['url']);
        
        if (empty($email))
        {
            $error[] = 'Veuillez renseigner votr email.';
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
            $partner->setIdentifier($_SESSION['account']->Identifier());
            $partner->setEmail($email);
            $partner->setUrl($url);
            
            $partnerManager->Update($partner);
            $_SESSION['account'] = $partner;
            
            echo json_encode('success');
        }
        else
        {
            echo json_encode($error);
        }
    }
}
?>