<?php
declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'));

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/core/helpers.php';
require_once APP_ROOT . '/core/Database.php';
require_once APP_ROOT . '/core/Model.php';
require_once APP_ROOT . '/core/BaseCollectable.php';
require_once APP_ROOT . '/core/Controller.php';
require_once APP_ROOT . '/app/Models/User.php';
require_once APP_ROOT . '/app/Models/Collectable.php';
require_once APP_ROOT . '/core/Auth.php';
require_once APP_ROOT . '/core/App.php';

Auth::boot();

(new App())->run();
