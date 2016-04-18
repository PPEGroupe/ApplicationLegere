<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
	$postManager = new PostManager($db);
    $webUserManager = new WebUserManager($db);
	
    // Récupère la candidature avec l'identifiant envoyé par la requète AJAX avec l'internaute qui l'a créé
	$post = $postManager->Get($_POST['idPost']);
	$webUser = $webUserManager->Get($post->IdWebUser());
            
	echo '{"Post": ', $post->ToJson(), ', "WebUser": ', $webUser->ToJson(), '}';
}