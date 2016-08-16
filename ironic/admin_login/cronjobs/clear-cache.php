<?php
	require('config.php');
	//xoa file cu hon 1 thang
    	$files = glob($path.'libraries/cache/*.*');
	$curtime = time()- (30 * 24 * 60 * 60);
    	foreach ($files as $file) {
        	$modified = filemtime($file);
		if ($modified<$curtime)
			@unlink($file);
    	}
?>