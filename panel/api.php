<?php
require "../config.php";
header("Content-Type: application/json");

$action = $_POST["action"] ?? $_GET["action"] ?? "";

if ($action === "devices") {
    echo file_get_contents("../devices.json");
    exit;
}

if ($action === "logs") {
    $id = $_GET["id"] ?? "";
    $file = "../logs_$id.txt";
    echo file_exists($file) ? file_get_contents($file) : "";
    exit;
}

if ($action === "command") {
    if ($_POST["token"] !== MDM_TOKEN) {
        http_response_code(403);
        exit;
    }

    file_put_contents("../commands.json", json_encode([
        "command" => $_POST["cmd"],
        "timestamp" => time(),
        "device" => $_POST["device"]
    ], JSON_PRETTY_PRINT));

    echo json_encode(["ok"=>true]);
    exit;
}

if ($action === "dns") {
    file_put_contents("../commands.json", json_encode([
        "command" => "DNS_SET",
        "dns" => $_POST["dns"],
        "timestamp" => time()
    ], JSON_PRETTY_PRINT));

    echo json_encode(["ok"=>true]);
}
