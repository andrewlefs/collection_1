<? include_once "template/head.php";
	unset($_SESSION["redirect"]);
?>
<body>
<? include_once "template/bloglink.php";?>
<!--HEADER-->
<? include_once "template/header.php";?>
<!--END HEADER-->
<script type="text/javascript">
$.fn.ready(function(){
	alert($.browser.version);
});
</script>
<div class="centerdiv joinbg">
	Check browser
</div>

<!--FOOTER-->
<? include_once "template/footer.php";?>
<!--END FOOTER-->
</body>
</html>