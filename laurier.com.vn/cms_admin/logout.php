<?
session_start();
if(session_is_registered('logged'))
{
	unset($_SESSION['logged']);
	unset($_SESSION['role']);
	session_unset();
	session_destroy();
	header( "Location: login.php" );
}
else
{
	header( "Location: login.php" );
}
?>
