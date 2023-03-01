<?php

namespace app\controllers;

use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);
        //debug($product);
        if(empty($id)) {
            throw new NotFoundHttpException('Такого продукта нет');
        }

        $this->setMeta("{$product->title} :: " . \yii::$app->name, $product->keywords, $product->description); // Задаём мета-теги        

        return $this->render('view', compact('product')); // Рендерим карточку товара
    }
}