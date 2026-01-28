<?php
require "config.php";

header("Content-Type: application/json");

$token = $_POST["token"] ?? "";
$cmd   = $_POST["cmd"] ?? "";

$allowed = [
  "DEV_TEMP_ON","DEV_TEMP_OFF",

  "ENTER_KIOSK","EXIT_KIOSK",

  "WIFI_LOCK","WIFI_UNLOCK",
  "DNS_LOCK","DNS_UNLOCK","DNS_SET","DNS_ENABLE",

  "FR_LOCK","FR_UNLOCK",

  "STATUSBAR_LOCK","STATUSBAR_UNLOCK",

  "UPDATES_OFF","UPDATES_ON",

  "REBOOT","FACTORY_RESET"
];

if ($token !== MDM_TOKEN) {
  http_response_code(403);
  echo json_encode(["error"=>"invalid token"]);
  exit;
}

if (!in_array($cmd, $allowed)) {
  http_response_code(400);
  echo json_encode(["error"=>"invalid command"]);
  exit;
}

file_put_contents("commands.json", json_encode([
  "command"   => $cmd,
  "timestamp"=> time()
], JSON_PRETTY_PRINT));

echo json_encode([
  "status"=>"ok",
  "cmd"=>$cmd
]);
