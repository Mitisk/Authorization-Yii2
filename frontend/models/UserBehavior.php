<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_behavior".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $wrong_password
 * @property string|null $ip
 * @property string $time_at
 * @property int $weight
 */
class UserBehavior extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_behavior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_at'], 'safe'],
            [['weight'], 'integer'],
            [['username', 'wrong_password', 'ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * Добавление маркера плохого поведения
     */
    public function addBadBehavior($username, $password = NULL, $weight = 1) {
        if ($this->validate()) {
            $model = new UserBehavior();
            $model->username = $username;
            $model->wrong_password = $password;
            $model->time_at = strtotime(date("Y-m-d H:i:s"));
            $model->ip = $_SERVER['REMOTE_ADDR'];
            $model->weight = $weight;
            $model->save();
            return true;
        }
    }


    /**
     * Проверка действий пользователя
     */

    public static function findBadBehavior($username, $at = 'UIT') {
        $sec_to_add = 60;
        $match_time = strtotime(date("Y-m-d H:i:s")) - $sec_to_add;

        /*
         * Поиск плохого поведения по uit (USERNAME, IP, Time_at)
         */
        if ($at === 'UIT') {
            $findBadBehavior = UserBehavior::find()->where(['username' => $username])->andWhere(['ip' => $_SERVER['REMOTE_ADDR']])->andWhere('time_at >= '.$match_time)->sum('weight');
        }
        if ($at === 'IT') {
            $findBadBehavior = UserBehavior::find()->where(['ip' => $_SERVER['REMOTE_ADDR']])->andWhere('time_at >= '.$match_time)->sum('weight');
        }

        if ($findBadBehavior >= 3) {
            return true;
        }
        return false;
    }

}
