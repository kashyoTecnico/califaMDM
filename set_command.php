<?php
require "config.php";
header("Content-Type: application/json");

$token = $_POST["token"] ?? "";
$cmd   = $_POST["cmd"] ?? "";

$allowed = [
  "DEV_TEMP_ON","DEV_TEMP_OFF",
  "WIFI_LOCK","WIFI_UNLOCK",
  "DNS_LOCK","DNS_UNLOCK",
  "FR_LOCK","FR_UNLOCK",
  "LOCK","UNLOCK","REBOOT"
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

file_put_contents(CMD_FILE, json_encode([
  "command" => $cmd,
  "timestamp" => time()
], JSON_PRETTY_PRINT));

echo json_encode([
  "status"=>"ok",
  "cmd"=>$cmd,
  "ts"=>time()
]);
