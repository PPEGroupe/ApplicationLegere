<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']) || empty($_POST['company']))
    {
        $error[] = 'L\'email n\est pas valide.';
    }
    else
    {
        $accountManager = new AccountManager($db);
        $clientManager  = new ClientManager($db);
        
        $company              = trim($_POST['company']);
        $email                = trim($_POST['email']);
        $password             = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['passwordConfirmation']);
        $encryptedPassword    = md5($password);
        
        if (strlen($email) < 3 || preg_match($regexEmail, $email) == 0) 
        {
            $error[] = 'L\'email est composé de plus de 3 caractères.';
        }
        else if (strlen($password) < 6)
        {
            $error[] = 'Veuillez renseigner un mot de passe de plus de 6 caractères.';
        }
        else if (preg_match($regexPassword, $password) == 0)
        {
            $error[] = 'Veuillez renseigner un mot de passe valide!
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
                // Vérifie si la société n'a pas déjà été enregistrée
                if (!$clientManager->CompanyExists($company))
                {
                    // Vérifie si un client est déjà lié au compte connecté
                    if (!$clientManager->AccountLinked($_SESSION['account']->Identifier()))
                    {
                        // Vérifie que le mot de passe renseigné correspond avec celui du compte connecté.
                        if ($_SESSION['account']->Password() == $encryptedPassword) 
                        {
                            $client = new Client();
                            $client->SetCompany($company);
                            $client->SetIdAccount($_SESSION['account']->Identifier());
                            $clientManager->Add($client);
                        }
                        else
                        {
                            $error[] = 'Pour utiliser votre compte en tant qu\'internaute,
                                        veuillez indiquer le mot de passe correspondant.';
                        }
                    }
                    else
                    {
                        $error[] = 'Un compte d\'entreprise est déjà lié à ce compte.';
                    }
                }
                else
                {
                    $error[] = 'Cette société est déjà renseignée.';
                }
            }
            else 
            {
                $error[] = 'Cet identifiant existe déjà.';
            }
        }
        else
        {
            $account = new Account();
            $client = new Client();
            
            $account->setEmail($email);
            $account->setPassword($encryptedPassword);
            $accountManager->Add($account);

            $account = $accountManager->GetAccount($email, $encryptedPassword);
            
            $client->setIdAccount($account->Identifier());
            $client->setCompany($company);
            
            if ($account != null && $client != null)
            {
                $clientManager->Add($client);  
            } 
            else 
            {
                $error[] = 'L\'ajout n\'a pas fonctionné, merci de contacter le support.';
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