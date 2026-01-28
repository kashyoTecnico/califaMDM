<?php
require "../config.php";

$data = file_exists(DATA_FILE)
    ? json_decode(file_get_contents(DATA_FILE), true)
    : [];

echo json_encode($data);
