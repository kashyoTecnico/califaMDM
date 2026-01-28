<?php
// ============================
// HEARTBEAT MDM CALIFA
// ============================

require "config.php";
header("Content-Type: application/json; charset=utf-8");

// Datos recibidos del dispositivo
$token  = $_POST["token"]  ?? "";
$device = $_POST["device"] ?? "";
$model  = $_POST["model"]  ?? "unknown";
$android= $_POST["android"]?? "unknown";

// Validación básica
if ($token !== MDM_TOKEN || empty($device)) {
    http_response_code(403);
    echo json_encode(["error" => "invalid token or device"]);
    exit;
}

// Archivo donde se guardan los dispositivos
$devicesFile = __DIR__ . "/devices.json";

// Cargar dispositivos existentes
$devices = [];
if (file_exists($devicesFile)) {
    $json = file_get_contents($devicesFile);
    $devices = json_decode($json, true) ?: [];
}

// Actualizar / registrar dispositivo
$devices[$device] = [
    "device_id" => $device,
    "model"     => $model,
    "android"   => $android,
    "last_seen" => time()
];

// Guardar
file_put_contents(
    $devicesFile,
    json_encode($devices, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

// Respuesta
echo json_encode([
    "status" => "ok",
    "device" => $device,
    "time"   => time()
]);
