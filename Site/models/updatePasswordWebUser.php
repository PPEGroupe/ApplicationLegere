<?php

require 'ClassesLoader.php';
require 'page.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';

if (!empty($_POST)) 
{
    // Vérifie l'existance des sessions 'account' et 'connected' et vérifie que le compte sélectionné est 'webUser'.
    if (isset($_SESSION['account']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'webUser')
    {
        $accountManager  = new AccountManager($db);
        
        $account = $accountManager->Get($_SESSION['account']->Password());
        $account->Initialize($_POST);
        
        $oldPassword           = md5(trim($_POST['oldPassword']));
        $newPassword           = trim($_POST['newPassword']);
        $confirmationPassword  = trim($_POST['passwordConfirmation']);
        $encryptedPassword     = md5($newPassword);
    
        if (empty($oldPassword) || empty($newPassword)  || empty($confirmationPassword))
        {
             $error[] = 'Veuillez remplir tous les champs.'; 
        }
        else 
        {
            if ($oldPassword != $password)
            {
                $error[] = 'L\'ancien mot de passe est incorrect.';
            }
            else if (preg_match($regexPassword, $newPassword) == 0)
            {
                $error[] = 'Veuillez renseigner un mot de passe valide!
                            Il doit contenir au moins 6 caractères dont une lettre et un chiffre';
            }
            else if ($newPassword != $confirmationPassword)
            {
                $error[] = 'Les deux nouveaux mots de passe ne correcpondent pas!';
            }
        }
        
        if(!isset($error))
        {
            //Modifie le mot de passe
            $account->setPassword($newPassword);
            
            //Met à jour la BDD
            $accountManager->UpdatePassword($password);
            
            //Met à jour la session
            $_SESSION['account'] = $account;
            
            echo json_encode('success');
        }else
        {
            echo json_encode($error);
        }
    }
}
?>