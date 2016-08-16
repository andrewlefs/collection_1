<?php
    if ($handle = opendir('.')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                echo "<img src=\"/theme/images/$entry\" class=\"img_bank\" alt=\"$entry\" />";
            }
        }
        closedir($handle);
   }
?>