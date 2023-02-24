<?php

namespace app\controllers;

use yii\web\Controller;

// Главный контроллер сайта, от которого унаследованы все остальные контроллеры
class AppController extends Controller 
{
    
    public function beforeAction($action) // Функция, которая будет выполняться перед каждым экшном (аналог хука)
    {
        $this->view->title = \Yii::$app->name; // Присвоим заголовку веб-страницы значение name из файла config/web.php (это временное решение)
        return parent::beforeAction($action);
    }

}