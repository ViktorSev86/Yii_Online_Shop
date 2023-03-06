<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

// Модель для работы с таблицей Category базы данных
class Order extends ActiveRecord
{

    public static function tableName() // Имя таблицы в базе данных отличается от имени модели (т.к. ORDER зарегестрированное слово в SQL), поэтому метод обязателен
    {
        return 'orders'; 
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class, // Используем поведение
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'], // Событие, которое происходит перед вставкой, для полей created_at, updated_at будет установлена текущая дата
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'], // Перед обновлением для поля updated_at будет установлена текущая дата
                ],
                // По-умолчанию будет генерироваться метка времени UNIX
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'), // Вставляем в value текущее значение даты-времени
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            ['note', 'string'],
            ['email', 'email'],
            [['created_at', 'updated_at'], 'safe'],
            ['qty', 'integer'],
            ['total', 'number'],
            ['status', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'note' => 'Примечание',
        ];
    }

}