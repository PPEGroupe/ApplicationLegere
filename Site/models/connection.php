<?php require 'ClassesLoader.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';

//----------------------------------- Tests Connexion -----------------------------------
if (!empty($_POST))
{
    
    $clientManager = new ClientManager($db);
    $email         = trim($_POST['email']);
    $password      = trim($_POST['password']);
    
    if (empty($_POST['email']) || empty($_POST['password']) )
    {
        $error[] = 'Veuillez remplir tous les champs';
    } 
    if (strlen($email) < 3 ) 
    {
        $error[] = 'L\'email est invalide.';
    }
    else if (strlen($password) < 4)
    {
        $error[] = 'Le mot de passe est composé de plus de 4 caractères!';
    }
//    else if (preg_match($regexPassword, $password) == 0)
//    {
//        $errorConnection = 'Le mot de passe n\'est pas correct';
//    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $error[] = 'Veuillez remplir un e-mail valide';
    }
    else
    {
        $client = $clientManager->GetAccount($email, $password);

        if ($client != null)
        {
            $_SESSION['account'] = $client;
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