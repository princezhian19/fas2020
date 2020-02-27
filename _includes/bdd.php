<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=db_dilg_pmis;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
