<?php require '/models/ClassesLoader.php';

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAll();


require '/views/view-index.php';



