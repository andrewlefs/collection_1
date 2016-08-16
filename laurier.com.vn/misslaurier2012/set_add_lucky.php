<?
@session_start();
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<admin>';
	echo "<status_add>";
	echo "<numpass><![CDATA[".$_SESSION['adpass']."]]></numpass>";
	echo "</status_add>";
echo '</admin>';
?>