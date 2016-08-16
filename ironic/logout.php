<?php
session_start();
$sUrlBack = $_GET['url'];
unset ($_SESSION['nameLogin']);
header ("location: ".$sUrlBack);
?>