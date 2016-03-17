<?php require '/views/view-login.php';

if (isset ($_POST['sendRegister']))
{
    if ($_POST['identifierRegister'] == '' || $_POST['passwordRegister'] == '' )
    {
        $errorRegister = 'Veuillez remplir tous les champs';
    }
}
?>