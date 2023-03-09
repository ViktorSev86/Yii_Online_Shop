<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\Order;
use app\models\OrderProduct;

class CartController extends AppController
{

    public function actionChangeCart()
    {
        $id = \Yii::$app->request->get('id');
        $qty = \Yii::$app->request->get('qty');
        $product = Product::findOne($id);
        if(empty($product)){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if(empty($product)) {
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
        $session->open();
        $order = new Order();
        $order_product = new OrderProduct();
        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)) { // Если данные не сохранены, откатываем транзакцию
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа'); // Сообщаем пользователю об ошибке
                $transaction->rollBack();
            } else {
                $transaction->commit(); // Выполняем транзакцию
                \Yii::$app->session->setFlash('success', 'Ваш заказ принят');
                try{
                    \Yii::$app->mailer->compose('order', ['session' => $session])
                        ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                        ->setTo([$order->email, \Yii::$app->params['adminEmail']])
                        ->setSubject('Заказ на сайте')
                        ->send();
                }catch (\Swift_TransportException $e){
                    var_dump($e); die;
                }

                $session->remove('cart'); // Очищаем корзину
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh(); // Обновляем страницу
            }
        }

        return $this->render('checkout', compact('session', 'order', 'order_product'));
    }

}

