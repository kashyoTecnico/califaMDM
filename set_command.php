<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header_remove();
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("X-Content-Type-Options: nosniff");

require "config.php";

$token = $_GET["token"] ?? "";
$sign  = $_GET["sign"] ?? "";

// 🔐 validar token
if (!hash_equals(MDM_TOKEN, $token)) {
    http_response_code(403);
    echo json_encode(["error" => "invalid token"]);
    exit;
}

// 🔐 validar firma
$expected = hash("sha256", MDM_TOKEN . MDM_SECRET);
if (!hash_equals($expected, $sign)) {
    http_response_code(403);
    echo json_encode(["error" => "invalid sign"]);
    exit;
}

// 📦 si no hay comando
if (!file_exists(CMD_FILE)) {
    echo json_encode([
        "command"   => "NONE",
        "timestamp" => time()
    ]);
    exit;
}

// 📤 devolver comando
$cmd = file_get_contents(CMD_FILE);
echo $cmd;
