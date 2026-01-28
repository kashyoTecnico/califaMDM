<?php
define("MDM_TOKEN", "7429");
define("MDM_SECRET", "CALIFA_MDM_7429");

define("CMD_DIR", __DIR__."/cmd");
define("STATUS_DIR", __DIR__."/status");
define("ACK_DIR", __DIR__."/ack");
define("CMD_FILE", __DIR__ . "/commands.json");

// opcional: evitar errores silenciosos
error_reporting(E_ALL);
ini_set("display_errors", 0);

@mkdir(CMD_DIR);
@mkdir(STATUS_DIR);
@mkdir(ACK_DIR);
