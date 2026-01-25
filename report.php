<?php
header("Content-Type: application/json");
require "config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (($input["token"] ?? "") !== MDM_TOKEN) {
    echo json_encode(["error"=>"invalid token"]); exit;
}

file_put_contents(STATUS_FILE, json_encode([
  "device_time" => time(),
  "command" => $input["command"] ?? "",
  "result" => $input["result"] ?? "",
  "detail" => $input["detail"] ?? ""
], JSON_PRETTY_PRINT));

echo json_encode(["status"=>"reported"]);
