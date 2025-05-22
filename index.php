<?php

require_once __DIR__ . '/database/databaseConfig.php';
require_once __DIR__ . '/utility/Helper.php';
include_once __DIR__ . '/utility/Notification.php';
require_once __DIR__ . '/model/index.php';
require_once __DIR__ . '/route/index.php';
include __DIR__ . '/layout/index.php';

session_start();



// /Users/user/Desktop/php_class/components/index.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
Router($path);


