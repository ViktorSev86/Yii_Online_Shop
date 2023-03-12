<?php // Исправляем код, сгенерированный с помощью Gii, для работы с базой данных User

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord //\yii\base\BaseObject 
            implements \yii\web\IdentityInterface
{
    /*public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
    */

    public static function tableName() // Данный метод можно не создавать, т.к. имя модели соответствует имени таблицы в БД
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        /* foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null; */
    }

    public static function findByUsername($username)
    {
        /* foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null; */

        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        // return $this->password === $password;
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
