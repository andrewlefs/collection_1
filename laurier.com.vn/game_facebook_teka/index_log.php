<?
require_once("src/facebook.php");
$config = array('appId' => '285945271525783','secret' => '3fa4efce26b74a15a66b5b3b3e9ef2c2','cookie' => true);
$facebook = new Facebook($config);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GAME TEKA ON FACEBOOK</title>
<link rel="stylesheet" type="text/css" href="../js/facebox/facebox.css"/>
<script type="text/javascript" src="../js/jquery.js" /></script>
<script type="text/javascript" src="../js/facebox/facebox.js"></script>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body>
<?php
$user_id = $facebook->getUser();
$profile = $facebook->api('/me');
if($user_id)
{
?>
<!--<div style="position:absolute;top:-5px;"><img id="share_button" src="images/share_button2.png" width="71" height="36" style="cursor:pointer"></div>-->
<div style="text-align:center;font-weight:bold;font-size:16px;padding-bottom:10px;">Chào mừng bạn&nbsp;<span style="color:#F00"><?=$profile['name']?></span>&nbsp;đến với game Nấu Ăn Cùng TEKA!</div>
<div style="margin:auto;text-align:center;padding-top:0px;">
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="760" height="620" align="middle" id="FlashID">
    <param name="movie" value="main.swf" />
    <param name="quality" value="high" />
    <param name="swfversion" value="15.0.0.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
    <param name="expressinstall" value="../Scripts/expressInstall.swf" />
    <param name="wmode" value="transparent" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object data="main.swf" type="application/x-shockwave-flash" width="760" height="620" align="middle">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="swfversion" value="15.0.0.0" />
      <param name="expressinstall" value="../Scripts/expressInstall.swf" />
      <param name="wmode" value="transparent" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div id="fb-root"></div>
<script>
// Load the SDK Asynchronously
(function(d){
	 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement('script'); js.id = id; js.async = true;
	 js.src = "//connect.facebook.net/en_US/all.js";
	 ref.parentNode.insertBefore(js, ref);
}(document));

window.fbAsyncInit = function() {
	FB.init({appId: '285945271525783', status: true, cookie: true,xfbml: true});
}
/*
$(document).ready(function(){
	$('#share_button').click(function(e){
		e.preventDefault();
		FB.ui(
		{
			method: 'feed',
			name: 'Game xếp hình của laurier',
			link: 'http://www.laurier.com.vn/game_facebook/share_game.php',
			picture: 'http://www.laurier.com.vn/game_facebook/images/Laurier-game-facebook-icon.jpg',
			caption: 'Game xếp hình của Laurier Việt Nam',
			description: 'Các bạn hãy cùng thư giãn với trò chơi xếp hình của Laurier và nhận những phần quà từ chương trình nhé.',
			message: ''
		});
	});
});
*/
</script>
<?php
}
else{
	echo '<div style="text-align:center;font-weight:bold;font-size:16px;line-height:25px"><span style="color:#F00;font-size:24px">Nếu nhận được thông báo này bạn hãy làm theo chỉ dẫn để chơi game:</span><br>
  - Trên thanh menu của trình duyệt IE bạn chọn vào <span style="color:#F00;font-size:18px">Tools &rarr;Internet Options</span><br>- Khi cửa xổ <span style="color:#F00;font-size:18px">Internet Options</span> hiện ra bạn chọn vào thẻ <span style="color:#F00;font-size:18px">Privacy</span> bạn thấy một thanh scroll setting.<br>
- Bạn hãy kéo thanh scroll này về mức thấp nhất sau đó click vào nút <span style="color:#F00;font-size:18px">Apply</span> và cuối cùng click vào nút <span style="color:#F00;font-size:18px">OK</span> là xong. <br/>
<span style="color:#066">Bạn hãy vào lại game nhé. Chúc bạn chơi game vui vẽ!</span><br><img src="hinh_hd.jpg"/>
</div>';
}
?>
</body>
</html>