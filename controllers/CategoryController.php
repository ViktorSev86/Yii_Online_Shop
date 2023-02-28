<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionView($id)
    {
        // var_dump($id); Для отладки: проверяем, передаётся ли параметр id в функцию
        $category = Category::findOne($id);
        if(empty($category)) {
            throw new \yii\web\HttpException(404, 'Ошибка! Такой категории нет'); // Альтернативно можно использовать класс NotFoundHttpException
        }
        $this->setMeta("{$category->title} :: " . \yii::$app->name, $category->keywords, $category->description); 

        // Настроим постраничную навигацию, чтобы на одной странице выводилось, например, 4 продукта
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false,]); // pageSize - количество выводимых продуктов. По-умолчанию yii выводит 20 продуктов на одной странице. forcePageParam отключает гет-параметр на 1-й странице. pageSizeParam убирает из гет параметра лишнее (&per-page=1). Чтобы полностью убрать гет-параметры из URL нужно настроить правило в config\web
        $products = $query->offset($pages->offset)->limit($pages->limit)->all(); 
        
        return $this->render('view', compact('products', 'category', 'pages'));

        //$products = Product::find()->where(['category_id' => $id])->all();
        //return $this->render('view', compact('products', 'category'));
    }

    public function actionSearch()
    {
        $q = trim(\yii::$app->request->get('q')); // Получаем запрос из массива get средствами yii (с автоматической проверкой, чтобы не писать тернарные операторы и т.п.). Функция trim обрезает концевые пробелы.
        //var_dump($q);
        $this->setMeta("Поиск: {q} :: " . \yii::$app->name); // Установим title страницы
        if(!$q) {
            return $this->render('search'); // Если запрос пуст, просто вернём представление
        }
        $query = Product::find()->where(['like', 'title', $q]); // Запрос поиска
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10, 'forcePageParam' => false, 'pageSizeParam' => false,]); 
        $products = $query->offset($pages->offset)->limit($pages->limit)->all(); 

        return $this->render('search', compact('products', 'pages', 'q'));
    }
}