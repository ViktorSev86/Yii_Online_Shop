<?php

namespace app\models;

use yii\base\Model;

/*
 * Array(
 *      ['cart'] => [
 *          [2] => [
 *              'title' => 'TITLE',
 *              'price' => 10,
 *              'qty' => 2
 *          ],
 *      ],
 *      'cart.qty' => 2,
 *      'cart.sum' => 20,
 * )
 *
 * */

class Cart extends Model
{

    public function addToCart($product, $qty = 1) // Второй (не обязательный) параметр - количество товара
    {
        if(isset($_SESSION['cart'][$product->id])){ // Если товар есть в корзине, увеличиваем его количество
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$product->id] = [ // Добавляем нужную информацию о товаре в корзину
                'title' => $product->title,
                'price' => $product->price,
                'qty' => $qty,
                'img' => $product->img,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty; // Если количество существует в сессии, добавляем к нему количество, если нет, кладём количество в сессию
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }

}




