<?php 
require '/models/ClassesLoader.php';
require '/models/page.php';

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAllByClient(1);

require '/views/view-offers.php';
