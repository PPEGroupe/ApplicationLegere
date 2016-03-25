<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
	$postManager = new PostManager($db);
	$post = $postManager->Get($_POST['idPost']);
    
    echo $post->ToJson();
}