<?
include "../../../config.php";
header('Content-type: text/xml');
echo "<?xml version='1.0' encoding='UTF-8'?>";
$p=(isset($_SESSION["p"]))?$_SESSION["p"]:-1;
unset ($_SESSION["p"]);
echo "<p>".$p."</p>";
?>