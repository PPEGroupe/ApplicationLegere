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
        $account = $_SESSION['account'];
        
        
        //Récupère de la vue
        $oldPassword           = md5(trim($_POST['oldPassword']));
        $newPassword           = md5(trim($_POST['newPassword']));
        $confirmationPassword  = md5(trim($_POST['passwordConfirmation']));
        $password              = $account->Password();
        
        //var_dump($password);
        //var_dump($oldPassword);
        //Fait les tests sur le mot de passe.
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
            $account->setPassword($newPassword);
            
            //Met à jour la BDD par le Manager
            $accountManager->UpdatePassword($account);
            
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