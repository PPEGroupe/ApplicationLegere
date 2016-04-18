<?php
// Renvoie 'class="selected"' si le nom de la page est celui envoyé en paramètre
function Selected($page) 
{
	if ($_SERVER['PHP_SELF'] == '/'.$page.'.php')
	{
		echo 'class="selected"';
	}
}

// Renvoie 'selected ' si le nom de la page est celui envoyé en paramètre
function SelectedWithoutClass($page) 
{
	if ($_SERVER['PHP_SELF'] == '/'.$page.'.php')
	{
		echo 'selected ';
	}
}