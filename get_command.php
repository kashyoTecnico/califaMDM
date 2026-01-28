<?php
require "config.php";

$token  = $_GET["token"] ?? "";
$device = $_GET["device"] ?? "";

if ($token !== MDM_TOKEN || !$device) {
    http_response_code(403);
    exit;
}

$data = json_decode(file_get_contents(DATA_FILE), true);

$cmd = $data[$device]["pending_cmd"] ?? "NONE";
$ts  = $data[$device]["cmd_ts"] ?? 0;

echo json_encode([
    "command"   => $cmd,
    "timestamp" => $ts
]);
