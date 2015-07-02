<?php 

include_once "../connection.php";
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$drop = $db->prepare("Delete From Events Where 1=1");
$drop->execute();

$drop = $db->prepare("Delete From SignIn Where 1=1");
$drop->execute();

$drop = $db->prepare("Delete From Members Where 1=1");
$drop->execute();

$drop = $db->prepare("Delete From News Where 1=1");
$drop->execute();





?>