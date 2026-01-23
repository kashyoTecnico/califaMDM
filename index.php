<?php
header_remove();
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("X-Content-Type-Options: nosniff");

require "config.php";

$token = $_GET["token"] ?? "";
$sign  = $_GET["sign"] ?? "";

// 🔐 validar token
if ($token !== MDM_TOKEN) {
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
        "command" => "NONE",
        "timestamp" => time()
    ]);
    exit;
}

// 📤 devolver comando
readfile(CMD_FILE);
