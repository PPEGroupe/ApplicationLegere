<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $accountManager = new AccountManager($db);
        $webUserManager = new WebUserManager($db);
        
        $email                = trim($_POST['email']);
        $password             = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['passwordConfirmation']);
        $encryptedPassword    = md5($password);
        
        if (strlen($email) < 3 || preg_match($regexEmail, $email) == 0) 
        {
            $error[] = 'L\'email n\est pas valide.';
        }
        else if (strlen($password) < 6)
        {
            $error[] = 'Veuillez renseigner un mot de passe de plus de 6 caractères.';
        }
        else if (preg_match($regexPassword, $password) == 0)
        {
            $error[] = 'Veuillez renseigner un mot de passe valide.
                        Il doit contenir au moins 6 caractères dont une lettre et un chiffre.';
        }
        else if ($password != $passwordConfirmation)
        {
            $error[] = 'Les mots de passe ne correspondent pas.';
        }
        else if ($accountManager->EmailExists($email))
        {
            // Si l'email existe déjà, on vérifie si l'utilisateur est déjà connecté, dans ce cas, on vérifie si l'email renseigné est celui du compte connecté.
            if (isset($_SESSION['account']) && $_SESSION['account']->Email() == $email)
            {
                // L'utilisateur est connecté et l'email renseigné est celui du compte connecté.
                // Vérifie si un internaute est déjà lié au compte connecté
                if (!$webUserManager->AccountLinked($_SESSION['account']->Identifier()))
                {
                    // Vérifie que le mot de passe renseigné correspond avec celui du compte connecté.
                    if ($_SESSION['account']->Password() == $encryptedPassword) 
                    {
                        $webUser = new WebUser();
                        $webUser->SetIdAccount($_SESSION['account']->Identifier());
                        $webUserManager->Add($webUser);
                    }
                    else
                    {
                        $error[] = 'Pour utiliser votre compte en tant qu\'internaute,
                                    veuillez indiquer le mot de passe correspondant';
                    }
                }
                else
                {
                    $error[] = 'Un compte d\'entreprise est déjà lié à ce compte.';
                }
            }
            else 
            {
<<<<<<< HEAD
                $error[] = 'Cet identifiant existe déjà.';
=======
                $error[] = 'Ce compte utilisateur existe déjà!';
>>>>>>> b319f1bfd1da6e67c83c2f9829b3a377a1a00b99
            }
        }
        else
        {
            $account = new Account();
            $webUser = new WebUser();
            
            $account->setEmail($email);
            $account->setPassword($encryptedPassword);
            $accountManager->Add($account);
            
            $account = $accountManager->GetAccount($email, $encryptedPassword);
            
            $webUser->setIdAccount($account->Identifier());
            
            if ($account != null)
            {
                $webUserManager->Add($webUser);
            } 
            else 
            {
                $error[] = 'L\'ajout n\'a pas fonctionné, merci de contacter le support!';
            }
        }
    }
    
    if (isset($error))
    {
        echo json_encode($error);
    }
    else
    {
        echo json_encode('success');
    }
} 