<?php
require "config.php";

$token  = $_POST["token"] ?? "";
$device = $_POST["device"] ?? "";
$status = $_POST["status"] ?? "UNKNOWN";
$model  = $_POST["model"] ?? "ANDROID";

if ($token !== MDM_TOKEN || !$device) {
    http_response_code(403);
    exit;
}

$data = file_exists(DATA_FILE)
    ? json_decode(file_get_contents(DATA_FILE), true)
    : [];

if (!isset($data[$device])) {
    $data[$device] = [
        "model" => $model,
        "pending_cmd" => "NONE",
        "cmd_ts" => 0,
        "last_result" => "—"
    ];
}

$data[$device]["last_seen"] = time();
$data[$device]["status"]    = $status;

file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["ok"=>true]);
