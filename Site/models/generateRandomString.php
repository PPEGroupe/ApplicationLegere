<?php
// Renvoie une chaine de caractères aléatoire.
function GetString($length = 50)
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    $str = '';
    
    for($i = 0; $i <= $length; $i++)
    {
        $rand = rand(1, 36);
        $str .= substr($chars, $rand, 1);
    }
    
    return $str;
}