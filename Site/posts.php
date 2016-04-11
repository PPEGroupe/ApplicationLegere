<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'webUser')
{
    $webUser = $_SESSION['webUser'];

    $postManager = new PostManager($db);
    $postList = $postManager->GetAllByWebUser($webUser->Identifier());
    $numberPostWebUser = $postManager->CountByWebUser($webUser->Identifier());
	
    require '/views/view-posts.php';
}
else
{
    require '/views/view-denied.php';
}