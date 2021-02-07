<?php

require_once('vendor/autoload.php');

use STCoresTracker\Controllers\EnvLoader;

(new EnvLoader(__DIR__.'/.env'))->GetDBConfig();

print_r(getenv());