<?php

require 'ClassesLoader.php';
require 'page.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';

if (!empty($_POST)) 
{
    if (isset($_SESSION['account']))
    {
        $partnerManager = new PartnerManager($db);
        
        
        $partner = $partnerManager->Get($_SESSION['account']->Identifier());
        $partner->Initialize($_POST);
        
        
        $oldPassword           = trim($_POST['oldPassword']);
        $newPassword           = trim($_POST['newPassword']);
        $confirmationPassword  = trim($_POST['passwordConfirmation']);
    
        $passwordTest = $partner->Password();
        
        
        if( empty($oldPassword) || empty($newPassword)  || empty($confirmationPassword) )
        {
             $error[] = 'Veuillez remplir tous les champs.'; 
        }
        else 
        {
            if ($oldPassword != $passwordTest)
            {
                $error[] = 'L\'ancien mot de passe est incorrect.';
            }
            else if (preg_match($regexPassword, $newPassword) == 0)
            {
                $error[] = 'Veuillez renseigner un mot de passe valide!
                            Il doit contenir au moins 6 caractères dont une lettre et un chiffre.';
            }
            else if ($newPassword != $confirmationPassword)
            {
                $error[] = 'Les deux nouveaux mots de passe ne correcpondent pas!';
            }
        }
        if(!isset($error))
        {
           
            $partner->setPassword($newPassword);
            
            $partnerManager->UpdatePassword($partner);
            $_SESSION['account'] = $partner;
            
            echo json_encode('success');
        }else
        {
            echo json_encode($error);
        }
    }
}
?>