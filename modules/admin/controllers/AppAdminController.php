<?php

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

// Главный контроллер администраторской части сайта, от которого унаследованы все остальные контроллеры администраторской части
class AppAdminController extends Controller 
{
    public function behaviors() // Перебрасываем неавторизованных пользователей на страницу авторизации, используя поведение
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'], // Для неавторизованных администраторов разрешаем только авторизацию
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true, // Для авторизованных администраторов разрешаем всё
                        //'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}