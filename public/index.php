<?php

use core\App;

require_once '../vendor/autoload.php';
$app = new App();
$app->run();

echo '<pre>';
var_dump($_SERVER);
'</pre>';
