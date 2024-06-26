<?php

$env_file_name=".env";

require_once('core/App.php');
require_once('core/Maker.php');
require_once('core/Router.php');
require_once('core/Config.php');

require_once('core/commons/helpers.php');

use Apps\App;
use Apps\Config;

$config = new Config();
$config->load_env_file($env_file_name);

$app = new App();
$app->run();

