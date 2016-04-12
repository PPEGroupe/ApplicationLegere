<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
    $postManager = new PostManager($db);
    $webUserManager = new WebUserManager($db);
    $postList = $postManager->GetAllByOffer($_POST['idOffer']);
	
    $count = count($postList);
    
    if ($count > 0)
    {
        echo '[';
        foreach ($postList as $key => $post)
        {
            $webUser = $webUserManager->Get($post->IdWebUser());
            
            echo '{"Post": ', $post->ToJson(), ', "WebUser": ', $webUser->ToJson(), '}';
            
            if ($key < $count -1) {
                echo ',';
            }
        }
        echo ']';
    }
    else
    {
        echo '{}';
    }
}