<?php require 'ClassesLoader.php';

$regexPassword = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail    = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

if (!empty($_POST)) 
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']) || empty($_POST['url']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    }
    else
    {
        $partnerManager = new PartnerManager($db);
        $accountManager = new AccountManager($db);
        
        $email                = trim($_POST['email']);
        $url                  = trim($_POST['url']);
        $password             = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['passwordConfirmation']);
        $encryptedPassword    = md5($password);
        
        if (strlen($email) < 3 || preg_match($regexEmail, $email) == 0) 
        {
            $error[] = 'L\'email n\est pas valide.';
        }
        else if (strlen($password) < 6)
        {
            $error[] = 'Veuillez renseigner un mot de passe de plus de 6 caractères!';
        }
        else if (preg_match($regexPassword, $password) == 0)
        {
            $error[] = 'Veuillez renseigner un mot de passe valide!
                        Il doit contenir au moins 6 caractères dont une lettre et un chiffre';
        }
        else if ($password != $passwordConfirmation)
        {
            $error[] = 'Les mots de passe ne correspondent pas!';
        }
        else if ($accountManager->EmailExists($email))
        {
            // Si l'email existe déjà, on vérifie si l'utilisateur est déjà connecté, dans ce cas, on vérifie si l'email renseigné est celui du compte connecté.
            if (isset($_SESSION['account']) && $_SESSION['account']->Email() == $email)
            {
                // L'utilisateur est connecté et l'email renseigné est celui du compte connecté.
                // Vérifie si la société n'a pas déjà été enregistrée
                if (!$partnerManager->UrlExists($url))
                {
                    // Vérifie si un partenaire de diffusion est déjà lié au compte connecté
                    if (!$partnerManager->AccountLinked($_SESSION['account']->Identifier()))
                    {
                        // Vérifie que le mot de passe renseigné correspond avec celui du compte connecté.
                        if ($_SESSION['account']->Password() == $encryptedPassword) 
                        {
                            $partner = new Partner();
                            $partner->SetIdAccount($_SESSION['account']->Identifier());
                            $partner->SetUrl($url);
                            $partnerManager->Add($partner);
                        }
                        else
                        {
                            $error[] = 'Pour utiliser votre compte en tant que partenaire de diffusion,
                                        veuillez indiquer le mot de passe correspondant';
                        }
                    }
                    else
                    {
                        $error[] = 'Un compte de partenaire est déjà lié à ce compte.';
                    }
                }
                else
                {
                    $error[] = 'Ce site web est déjà renseigné.';
                }
            }
            else 
            {
                $error[] = 'Ce compte partenaire existe déjà!';
            }
        }
        else
        {
            $account = new Account();
            $partner = new Partner();
            
            $account->setEmail($email);
            $account->setPassword($encryptedPassword);
            $accountManager->Add($account);

            $account = $accountManager->GetAccount($email, $encryptedPassword);
            
            $partner->setIdAccount($account->Identifier());
            $partner->setURL($url);
            
            if ($account != null && $partner != null)
            {
                $partnerManager->Add($partner);
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