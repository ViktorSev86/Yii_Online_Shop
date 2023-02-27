<?php

namespace app\controllers;

use app\models\Product;

class HomeController extends AppController
{
    public function actionIndex()
    {
        $offers = Product::find()->where(['is_offer' => 1])->limit(4)->all();
        //debug($offers);
        return $this->render('index', compact('offers')); // Рендерим главную страницу сайта
    }
}