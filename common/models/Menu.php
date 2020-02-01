<?php

namespace common\models;


use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use backend\components\NestedSetsTreeBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string|null $description
 * @property string $url
 */
class Menu extends \yii\db\ActiveRecord
{
    public $sub;

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
            'htmlTree' => [
                'class' => NestedSetsTreeBehavior::className()
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['lft', 'rgt', 'depth', 'sub'], 'integer'],
            [['description'], 'string'],
            [['name', 'url'], 'string', 'max' => 255],
            [['lft', 'rgt', 'depth'], 'safe'],
            ['url', 'unique', 'message' => 'Этот адрес уже занят']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Название*',
            'description' => 'Описание',
            'url' => 'Url*',
            'sub' => 'Родительская категория',
        ];
    }

    public static function getDropDownParentCathegoryList() {
        $list = ArrayHelper::map(self::find()->all(), 'id', 'name');
        return $list;
    }

}
