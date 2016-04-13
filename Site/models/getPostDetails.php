<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
	$postManager = new PostManager($db);
    $webUserManager = new WebUserManager($db);
	
	$post = $postManager->Get($_POST['idPost']);
	$webUser = $webUserManager->Get($post->IdWebUser());
            
	echo '{"Post": ', $post->ToJson(), ', "WebUser": ', $webUser->ToJson(), '}';
}