<?php
$command = escapeshellcmd('open_recycle_bin.bat');
$output = shell_exec($command);

echo "Opening Recycling Bin...";
?>
