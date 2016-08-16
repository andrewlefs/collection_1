<?php
session_start();
unset ($_SESSION['iLoginUser']);
header ("location: login.php");
?>