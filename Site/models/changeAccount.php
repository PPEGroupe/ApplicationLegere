<?php require 'ClassesLoader.php';

if (!empty($_POST) && isset($_POST['target']))
{
    $target = $_POST['target'];
    
    if (in_array($target, array('client', 'partner', 'webUser')))
    {
        $_SESSION['connected'] = $target;
    }
}