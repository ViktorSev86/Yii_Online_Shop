<?php

namespace app\models;

use yii\db\ActiveRecord;

// Модель для работы с таблицей Category базы данных
class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'category'; 
    }

}