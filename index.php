<?php
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

require "config.php";

$token = $_GET["token"] ?? "";
$sign  = $_GET["sign"] ?? "";

if ($token !== MDM_TOKEN) {
    echo json_encode([
        "command" => "NONE",
        "timestamp" => time(),
        "error" => "invalid token"
    ]);
    exit;
}

$expected = hash("sha256", MDM_TOKEN . MDM_SECRET);
if (!hash_equals($expected, $sign)) {
    echo json_encode([
        "command" => "NONE",
        "timestamp" => time(),
        "error" => "invalid sign"
    ]);
    exit;
}

if (!file_exists(CMD_FILE)) {
    echo json_encode([
        "command" => "NONE",
        "timestamp" => time()
    ]);
    exit;
}

$cmd = json_decode(file_get_contents(CMD_FILE), true);

if (!isset($cmd["command"], $cmd["timestamp"])) {
    echo json_encode([
        "command" => "NONE",
        "timestamp" => time()
    ]);
    exit;
}

echo json_encode($cmd);
