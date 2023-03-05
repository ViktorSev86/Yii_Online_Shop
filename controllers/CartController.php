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
        if(\Yii::$app->request->isAjax){ // Если запрос пришёл Аяксом, рендерим вид без шаблона
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

    public function actionDelItem()
    {
        $id = \Yii::$app->request->get('id');
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        if(\Yii::$app->request->isAjax){ // Если запрос пришёл Аяксом, рендерим вид без шаблона
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(\Yii::$app->request->referrer); // Если запрос пришёл не аяксом, редирект на страницу, с которой пришёл пользователь
    }

    public function actionClear()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart'); // Удаляем из сессии все товары по ключу cart
        $session->remove('cart.qty'); // Удаляем общее количество товаров в корзине
        $session->remove('cart.sum'); // Удаляем итоговую сумму заказа
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionCheckout()
    {
        $this->setMeta("Оформление заказа :: " . \yii::$app->name); // Задаём мета-теги
        $session = \Yii::$app->session;
        
        

        return $this->render('checkout', compact('session'));
    }

}

