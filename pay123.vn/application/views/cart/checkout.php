<?php 
echo '<div class="col-md-9 g-home" role="main">';
if($err == 1)
{
	echo 'Xin lỗi, chúng tôi đang cập nhật kho thẻ, bạn hãy giữ nguyên trang này và ấn Tải lại trang sau ít phút để nhận mã thẻ';
}
else
{
	foreach($output AS $k=> $mang)
	{
		echo '<strong>'.ucfirst($k).'</strong><br>';
		foreach($mang AS $the)
		{
			$this->card->gettedCode($user['id'], $the['id'], $the['price']);
			echo 'Seri: '.water($the['seri']).' - Mã: '.water($the['ma']).'<br/>';
		}
		echo '<br><br>';
	}
}
echo '</div>';