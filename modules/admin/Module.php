<?php

namespace app\modules\admin;

use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

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
