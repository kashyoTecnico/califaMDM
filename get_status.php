<?php
$devices=[];

foreach (glob("status/*.json") as $f) {
 $id=basename($f,".json");
 $devices[$id]=json_decode(file_get_contents($f),true);
}

echo json_encode($devices,JSON_PRETTY_PRINT);
