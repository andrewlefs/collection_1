<?php
    if ($handle = opendir('.')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                echo "<div style=\"background: url(/theme/card/$entry)\">dsfsd</div>";
            }
        }
        closedir($handle);
   }
?>