<?
session_start();
if(session_is_registered('user'))
{
	unset($_SESSION['user']);
	unset($_SESSION['loggedgame']);
	session_unset();
	session_destroy();
	header( "Location: ../index.php" );
}
else
{
	header( "Location: ../index.php" );
}
?>