<?php require 'ClassesLoader.php';

$regexPassword        = '#^(?=.*[a-z])(?=.*[0-9]).{6,}$#';
$regexEmail           = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';



//----------------------------------- Tests Inscription -----------------------------------
if (!empty($_POST)) 
{
    if (empty($_POST['email'])|| ($_POST['password']) || ($_POST['passwordConfirmation']) || ($_POST['company']))
    {
        $error[] = 'Veuillez remplir tous les champs';
    } 
    $clientManager        = new ClientManager($db);
    $company              = trim($_POST['company']);
    $email                = trim($_POST['email']);
    $password             = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);


    if (strlen($email) < 3 ) 
    {
        $error[] = 'L\'email est composé de plus de 3 caractères!';
    }
    else if (strlen($password) < 4)
    {
        $error[] = 'Le mot de passe est composé de plus de 4 caractères!';
    }
//    else if (preg_match($regexPassword, $password) == 0)
//    {
//        $errorRegister = 'Le mot de passe n\'est pas conforme aux exigenences!'
//        . '</br>Il doit avoir au moin 6 caractères'
//        . '</br>Il doit comporter au moin une majuscule'
//        . '</br>Il doit comporter au moin un chiffe.';
//    }
    else if (preg_match($regexEmail, $email) == 0)
    {
        $error[] = 'Veuillez remplir un e-mail valide';
    }
    else if ($clientManager->Exist($email))
    {
         $error[] = 'Cet Identifiant existe déjà!';
    }
    else
    {
        $client = new Client(); 
        $client->setCompany($company);
        $client->setEmail($email);
        $client->setPassword($password);

        $clientManager->Add($client);
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

