<?php
require "config.php";

$token = $_GET["token"] ?? "";
$sign  = $_GET["sign"] ?? "";
$device= $_GET["device"] ?? "";

if ($token !== MDM_TOKEN ||
    hash("sha256",MDM_TOKEN.MDM_SECRET)!==$sign
) {
 echo json_encode(["error"=>"auth"]); exit;
}

$file = CMD_DIR."/$device.json";

if (!file_exists($file)) {
 echo json_encode(["command"=>"NONE","timestamp"=>time()]);
 exit;
}

readfile($file);
