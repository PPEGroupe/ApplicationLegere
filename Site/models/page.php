<?php
function Selected($page) 
{
	if ($_SERVER['PHP_SELF'] == '/'.$page.'.php')
	{
		echo 'class="selected"';
	}
}

function SelectedWithoutClass($page) 
{
	if ($_SERVER['PHP_SELF'] == '/'.$page.'.php')
	{
		echo 'selected ';
	}
}