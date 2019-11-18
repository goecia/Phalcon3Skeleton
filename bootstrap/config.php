<?php

use \Phalcon\Config\Adapter\Grouped;

// Load configuration files
$basePath = BASE . '/config/{global,' . ENVIRONMENT . '}';
$paths = [];
foreach (glob($basePath .'*', GLOB_ONLYDIR|GLOB_BRACE) as $dir) {
    $paths = array_merge($paths, glob($dir.'/*.php'));
}

return new Grouped($paths);
