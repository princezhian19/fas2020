<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
