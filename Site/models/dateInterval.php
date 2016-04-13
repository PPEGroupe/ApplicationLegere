<?php
function DateInterval($date)
{
	$now = new DateTime("now");
	
	$dateBegin = date_create($date);
	$interval = date_diff($dateBegin, $now);
	return $interval->format('%a');
}