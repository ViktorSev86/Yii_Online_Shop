<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

    public static function tableName() // Данный метод можно не создавать, т.к. имя модели соответствует имени таблицы в БД
    {
        return 'product';
    }

    public function getCategory() // Получение родительской категории для вывода её в хлебных крошках карточки продукта
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']); // Связываем с моделью категории по id категории
    }

}