<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAll();

require '/views/view-index.php';
