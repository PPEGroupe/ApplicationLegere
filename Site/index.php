<?php require '/models/ClassesLoader.php';

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAll();

if (isset($_POST['sendPost']))
{
    $postManager = new PostManager($db);
    $post = new Post();
    $post->Initialize($_POST);
    
    $postManager->Add($post);
    header('Location : index.php');
    exit();
}

require '/views/view-index.php';
