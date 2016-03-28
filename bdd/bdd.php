<?php
$host="localhost";
$dbname="rssbdd";
$username="root";
$pwd="root";
$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.'',''.$username.'',''.$pwd.'');
$bdd->exec("SET CHARACTER SET utf8");
?>