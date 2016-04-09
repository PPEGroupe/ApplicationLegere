<?php require 'ClassesLoader.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Tests Connexion -----------------------------------
if (!empty($_POST))
{
    $accountManager  = new accountManager($db);
    
    $email    = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    
    if (empty($_POST['email']) || empty($_POST['password']) )
    {
        $error[] = 'Veuillez remplir tous les champs';
    } 
    else if (strlen($email) < 3 ) 
    {
        $error[] = 'L\'email est invalide.';
    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $error[] = 'Veuillez remplir un e-mail valide';
    }
    else
    {
        $account = $accountManager->GetAccount($email, $password);

        if ($account != null)
        {
            $_SESSION['account'] = $account;
        }
        else
        {
            $error[] = 'Vous n\' êtes pas connu du site, inscrivez-vous :)';
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