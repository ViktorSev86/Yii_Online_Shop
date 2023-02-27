<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

    public static function tableName() // Данный метод можно не создавать, т.к. имя модели соответствует имени таблицы в БД
    {
        return 'product';
    }

}