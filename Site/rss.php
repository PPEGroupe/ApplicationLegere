<?php
require '/models/ClassesLoader.php';
require '/models/page.php';

header('Content-Type: application/xml; charset=utf8');

$offerManager = new OfferManager($db);
$offerList = $offerManager->GetAll();

if (isset($_SESSION['account']))
{
    $client = $_SESSION['account'];
    $numberOfferClient = $offerManager->CountByClient($client->Identifier());
	
	$xml  = '<?xml version="1.0" encoding="iso-8859-1"?>'.PHP_EOL;
	$xml .= '<rss version="2.0">'.PHP_EOL;
	$xml .= '<channel>'.PHP_EOL; 
	
	foreach ($offerList as $key => $offer)
	{
		$title = $offer->Title();
		$description  = $offer->ProfileDescription();
		$date = date("D, d M Y H:i:s", strtotime($offer->DateStartPublication()));
		$link = 'http://megacasting.fr?offer='. $offer->Identifier();
		
		$xml .= '	<item>'.PHP_EOL;
		$xml .= '		<title>'. $title .'</title>'.PHP_EOL;
		$xml .= '		<description>'. $description .'</description>'.PHP_EOL;
		$xml .= '		<pubDate>'. $date .'</pubDate>'.PHP_EOL;
		$xml .= '		<link>'. $link .'</link>'.PHP_EOL;
		$xml .= '	</item>'.PHP_EOL;
	}
	
	$xml .= '</channel>'.PHP_EOL; 
	$xml .= '</rss>'; 
    
    echo $xml;
}