<?php

namespace app\controllers;

use yii\web\Controller;

// Главный контроллер сайта, от которого унаследованы все остальные контроллеры
class AppController extends Controller 
{
    // Метод, который будет выполняться перед каждым экшном (аналог хука)
    public function beforeAction($action) 
    {
        $this->view->title = \Yii::$app->name; // Присвоим заголовку веб-страницы значение name из файла config/web.php (это временное решение)
        return parent::beforeAction($action);
    }

    // Метод для вывода мета-тегов
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}