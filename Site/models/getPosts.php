<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
    $postManager = new PostManager($db);
    $webUserManager = new WebUserManager($db);
    
    // Récupère la liste des candidatures liées à l'offre avec l'identifiant envoyé par la requète AJAX
    $postList = $postManager->GetAllByOffer($_POST['idOffer']);
	
    $count = count($postList);
    
    if ($count > 0)
    {
        echo '[';
        // Parcours chaque candidature
        foreach ($postList as $key => $post)
        {
            // Récupère l'internaute qui a envoyé la candidature
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