<?php
require 'ClassesLoader.php';

if (isset($_POST))
{
	$postManager = new PostManager($db);
	$postList = $postManager->GetAllByOffer($_POST['idOffer']);
	
    $count = count($postList);
    
    if ($count > 0)
    {
		echo '[';
        foreach ($postList as $key => $post)
        {
            echo $post->ToJson();
            
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