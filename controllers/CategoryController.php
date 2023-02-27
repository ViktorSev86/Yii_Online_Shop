<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

class CategoryController extends AppController
{
    public function actionView($id)
    {
        // var_dump($id); Для отладки: проверяем, передаётся ли параметр id в функцию
        $category = Category::findOne($id);
        if(empty($category)) {
            throw new \yii\web\HttpException(404, 'Ошибка! Такой категории нет'); // Альтернативно можно использовать класс NotFoundHttpException
        }
        $products = Product::find()->where(['category_id' => $id])->all();
        return $this->render('view', compact('products', 'category'));
    }
}