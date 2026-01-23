<?php
require "config.php";

$cmd   = $_POST["cmd"] ?? "";
$token = $_POST["token"] ?? "";

// comandos permitidos
$allowed = [
    "DNS_LOCK",
    "DNS_UNLOCK",
    "WIFI_LOCK",
    "WIFI_UNLOCK",
    "FR_LOCK",
    "FR_UNLOCK",
    "UNLOCK",
    "REBOOT",
    "DEV_TEMP_ON",
    "DEV_TEMP_OFF"
];

if (!in_array($cmd, $allowed, true)) {
    die("CMD NO PERMITIDO");
}

if ($token !== MDM_TOKEN) {
    die("TOKEN INVALIDO");
}

// guardar comando + timestamp
file_put_contents(CMD_FILE, json_encode([
    "command" => $cmd,
    "timestamp" => time()
], JSON_PRETTY_PRINT));

echo "OK -> $cmd";
