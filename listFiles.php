<?php
if ($handle = opendir('.')) {
    $i=1;
    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != ".git" 
         && $entry != "index.php" && $entry != "listFiles.php" && $entry != "README.md"
         && $entry != "result.php" && $entry != "style.less") {

            echo "<button onclick=\"readFile(this)\" class=\"file\" id=\"$entry\">$i. $entry</button><br>";
            $i++;
        }
    }
    closedir($handle);
}

?>