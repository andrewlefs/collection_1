<?php
@session_start();
if ( isset ( $GLOBALS["HTTP_RAW_POST_DATA"] )) {
	$uniqueStamp = date(U);
	$date_array = getdate();
	$filename = "upload_file_game/".$uniqueStamp.$date_array[0].".jpg";
	$fp = fopen( $filename,"wb");
	fwrite( $fp, $GLOBALS[ 'HTTP_RAW_POST_DATA' ] ); 
	fclose( $fp );
	$_SESSION['file']=$filename;
	echo "OK";
}
?>