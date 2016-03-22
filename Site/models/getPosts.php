<?php
require '/models/ClassesLoader.php';

$_POST['idOffer'] = 1;

if (isset($_POST))
{
	$postManager = new PostManager($db);
	$postList = $postManager->GetAllByOffer($_POST['idOffer']);
	
	echo json_encode($postList);
}