<?php
require "config.php";

$token = $_POST["token"] ?? "";
$cmd   = $_POST["cmd"] ?? "";
$device= $_POST["device"] ?? "broadcast";

$allowed = [
 "LOCK","UNLOCK","REBOOT",
 "WIFI_LOCK","WIFI_UNLOCK",
 "DNS_LOCK","DNS_UNLOCK",
 "FR_LOCK","FR_UNLOCK",
 "DEV_TEMP_ON","DEV_TEMP_OFF"
];

if ($token !== MDM_TOKEN || !in_array($cmd,$allowed)) {
 http_response_code(403); exit;
}

file_put_contents(
 CMD_DIR."/$device.json",
 json_encode(["command"=>$cmd,"timestamp"=>time()])
);

echo json_encode([
 "status"=>"ok",
 "cmd"=>$cmd,
 "message"=>"Comando enviado"
]);
