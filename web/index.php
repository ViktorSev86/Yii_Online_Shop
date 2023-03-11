<?php // Это фронт-контроллер

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true); // На реальном хостинге необходимо будет заакомментировать эту строку, чтобы убрать панель отладки внизу сайта
defined('YII_ENV') or define('YII_ENV', 'dev');    // На реальном хостинге необходимо будет заакомментировать эту строку, чтобы убрать панель отладки внизу сайта

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

require_once __DIR__ . '/../libs/funcs.php';

(new yii\web\Application($config))->run();
