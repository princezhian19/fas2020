<?php
try
{
        $bdd = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');
                
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
