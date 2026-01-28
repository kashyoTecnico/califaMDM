<?php
require "config.php";

file_put_contents(
 ACK_DIR."/".$_POST["device"].".json",
 json_encode([
   "cmd"=>$_POST["cmd"],
   "executed_at"=>time()
 ])
);
