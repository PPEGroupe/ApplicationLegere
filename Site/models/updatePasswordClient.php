<?php

require 'ClassesLoader.php';
require 'page.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';

if (!empty($_POST)) 
{
    if (isset($_SESSION['account']))
    {
        $clientManager         = new ClientManager($db);
        
        
        $client = $clientManager->Get($_SESSION['account']->Identifier());
        $client->Initialize($_POST);
        
        
        $oldPassword           = trim($_POST['oldPassword']);
        $newPassword           = trim($_POST['newPassword']);
        $confirmationPassword  = trim($_POST['passwordConfirmation']);
    
        $passwordTest = $client->Password();
        
        
        if( empty($oldPassword) || empty($newPassword)  || empty($confirmationPassword) )
        {
             $error[] = 'Veuillez remplir tous les champs.'; 
        }
        else 
        {
            if ($oldPassword != $passwordTest)
            {
                $error[] = 'l\'ancien mot de passe est incorrect.';
            } 
            else if (strlen($newPassword) < 4 ) 
            {
                $error[] ='Le mot de passe est composé de plus de 4 caractères!';
            }
            else if (preg_match($regexPassword, $newPassword) == 0)
            {
                $error[] = 'Le mot de passe n\'est pas conforme aux exigenences!'
                . '</br>Il doit avoir au moin 6 caractères'
                . '</br>Il doit comporter au moin une majuscule'
                . '</br>Il doit comporter au moin un chiffe.';
            }
            else if ($newPassword != $confirmationPassword)
            {
                $error[] = 'Les deux nouveaux mots de passe ne sont pas identiques!';
            }
        }
        if(!isset($error))
        {
           
            $client->setPassword($newPassword);
            
            $clientManager->UpdatePassword($client);
            $_SESSION['account'] = $client;
            
            echo json_encode('success');
        }else
        {
            echo json_encode($error);
        }
    }
}
?>