<?php

require 'ClassesLoader.php';
require 'page.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';

if (!empty($_POST)) 
{
// Vérifie l'existance des sessions / et la connexion des utilisateurs
    if (isset($_SESSION['account']) && isset($_SESSION['connected']) && $_SESSION['connected'] == 'client')
    {
        // Instancie le manager
        $accountManager  = new AccountManager($db);
        
        //Récupère en session
        $password = $accountManager->Get($_SESSION['account']->Password());
        $password->Initialize($_POST);
        
        //Récupère de la vue
        $oldPassword           = trim($_POST['oldPassword']);
        $newPassword           = trim($_POST['newPassword']);
        $confirmationPassword  = trim($_POST['passwordConfirmation']);
    
        //Fait les test sur l'email
        if( empty($oldPassword) || empty($newPassword)  || empty($confirmationPassword) )
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
            //Modifie les champs
            $password->setPassword($newPassword);
            
            //Met à jour la BDD par le Manager
            $accountManager->UpdatePassword($password);
            
            //Met à jour la session
            $_SESSION['account'] = $password;
            
            echo json_encode('success');
        }else
        {
            echo json_encode($error);
        }
    }
}
?>