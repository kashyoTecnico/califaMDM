<?php
header("Content-Type: application/json");
require "config.php";

$token = $_GET["token"] ?? "";
$sign  = $_GET["sign"] ?? "";

if ($token !== MDM_TOKEN) {
    echo json_encode(["error"=>"invalid token"]); exit;
}

$expected = hash("sha256", MDM_TOKEN.MDM_SECRET);
if (!hash_equals($expected, $sign)) {
    echo json_encode(["error"=>"invalid sign"]); exit;
}

if (!file_exists(CMD_FILE)) {
    echo json_encode(["command"=>"NONE","timestamp"=>time()]);
    exit;
}

readfile(CMD_FILE);
