<?php
header("Content-Type: application/json");
require "config.php";

if (!file_exists(STATUS_FILE)) {
    echo json_encode([
        "status" => "NO_REPORT",
        "message" => "El dispositivo aún no ha reportado"
    ]);
    exit;
}

readfile(STATUS_FILE);
