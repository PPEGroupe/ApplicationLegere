<?php
require 'ClassesLoader.php';

$_POST['idOffer'] = 2;

if (isset($_POST))
{
	$postManager = new PostManager($db);
	$postList = $postManager->GetAllByOffer($_POST['idOffer']);
	
    $count = count($postList);
    
	echo '{"count":', $count, ', "posts":[';
    if ($count > 0)
    {
        foreach ($postList as $key => $post)
        {
            echo $post->ToJson();
            
            if ($key < $count -1) {
                echo ',';
            }
        }
    }
    echo ']}';
}