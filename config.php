<?php
define("MDM_TOKEN", "7429");
define("MDM_SECRET", "CALIFA_MDM_7429");

define("CMD_DIR", __DIR__."/cmd");
define("STATUS_DIR", __DIR__."/status");
define("ACK_DIR", __DIR__."/ack");

@mkdir(CMD_DIR);
@mkdir(STATUS_DIR);
@mkdir(ACK_DIR);
