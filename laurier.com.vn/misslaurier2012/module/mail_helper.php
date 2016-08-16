<?
function send_mail($subject, $message,$fr,$to){
	/*  your configuration here  */
//ini_set("sendmail_path","/usr/sbin/sendmail -t");	
//info@icanrepairasia.com
ini_set("sendmail_from",$fr);	
$header="";
$header .= "Reply-To: HT <$fr>"."\n";
$header .= "Return-Path: HT <$fr>"."\n";
$header .= "From: <$fr>"."\n";
$header .= "Content-Type: text/html; charset=utf-8 "."\n";
$mail_sent = @mail($to, $subject, $message, $header); 
return $mail_sent ? "221" : "500";
}
?>