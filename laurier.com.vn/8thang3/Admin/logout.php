<?
session_start();
if(session_is_registered('user_name'))
{
	unset($_SESSION['user_name']);
	session_unset();
	session_destroy();
	header( "Location: login.php" );
}
else
{
	header( "Location: login.php" );
}
?>