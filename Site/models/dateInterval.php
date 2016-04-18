<?php
// Renvoie le nombre de jours entre la date envoyée et aujourd'hui.
function DateInterval($date)
{
	$now = new DateTime("now");
	
	$dateBegin = date_create($date);
	$interval = date_diff($dateBegin, $now);
    
	return $interval->format('%a');
}