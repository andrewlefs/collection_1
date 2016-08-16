<META http-equiv="refresh" content="5;URL=http://pay123.vn/cart/history">;
<?php 
echo '<div class="col-md-9 g-home" role="main">';
if($success != 'thanhcong')
{
	echo 'Giao dịch không thành công.';
}
else
{
	echo 'Giao dịch thành công. Bạn sẽ được chuyển tới danh sách thẻ trong giây lát.';
}
echo '</div>';