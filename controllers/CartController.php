<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;

class CartController extends AppController
{

    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if(empty($product)){
            return false;
        }
        $session = \Yii::$app->session; // Создаём сессию
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product); // Вызываем метод модели Cart
        if(\Yii::$app->request->isAjax){ // Если запрос пришёл Аяксом, рендерим вид
            return $this->renderPartial('cart-modal', compact('session')); // Рендерим вид (модальное окно корзины) без шаблона методом renderPartial()
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionShow()
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session')); // Если запрос пришёл не аяксом, перенаправляем пользователя на страницу, с которой он пришёл
    }

}

