<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calaba9_intranetdb;charset=utf8', 'calaba9_intra', '{^-LouqU_vpV');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
