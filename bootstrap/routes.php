<?php

// Load route files.
$routesPath = glob("{" . BASE . "/routes/*.php}", GLOB_BRACE);

// Include each route file.
foreach ($routesPath as $k => $v) {
    require_once($v);
}
