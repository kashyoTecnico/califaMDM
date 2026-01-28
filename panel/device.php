<?php
$device = $_GET["id"] ?? "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dispositivo <?=htmlspecialchars($device)?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>📱 Dispositivo: <?=$device?></h2>

<div id="controls">
    <?php
    $cmds = [
        "ENTER_KIOSK","EXIT_KIOSK",
        "WIFI_LOCK","WIFI_UNLOCK",
        "DNS_LOCK","DNS_UNLOCK",
        "STATUSBAR_LOCK","STATUSBAR_UNLOCK",
        "FR_LOCK","FR_UNLOCK",
        "REBOOT"
    ];
    foreach ($cmds as $c) {
        echo "<button onclick=\"sendCmd('$device','$c')\">$c</button>";
    }
    ?>
</div>

<script src="panel.js"></script>
</body>
</html>
