<? 
include_once("config.php");
include_once('htinmotion/orm/adodb5/adodb.inc.php');
include_once('htinmotion/orm/general/general.php');
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<data>';
$g=new general();
$lucky=$g->getSQL("select * from lucky_circle",0);
foreach($lucky as $k=>$i)
{
	echo "<status>";
	echo "<numchar><![CDATA[".$i["numchar"]."]]></numchar>";
	echo "<numran><![CDATA[".$i["numran"]."]]></numran>";
	echo "<started><![CDATA[".$i["started"]."]]></started>";
	echo "<finishs><![CDATA[".$i["finish"]."]]></finishs>";
	echo "</status>";
}
echo '</data>';
?>