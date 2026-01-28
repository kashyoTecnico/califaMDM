<?php
require "config.php";

file_put_contents(
 STATUS_DIR."/".$_POST["device"].".json",
 json_encode(["online"=>true,"last_seen"=>time()])
);
