<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Пользователи сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'username',
            'email',
            'phone',
            //'status',
            [
                'attribute'=>'status',
                'format' => 'raw',
                'value' => function($data){
                    if ($data->status == 10) {
                        $check = "<span class='badge badge-success'>активен</span>";
                    }
                    elseif ($data->status == 9) {
                        $check = "<span class='badge badge-warning'>Не активен</span>";
                    }
                    elseif ($data->status == 9) {
                        $check = "<span class='badge badge-warning'>Не активен</span>";
                    }

                    return $check;
},
            ],
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd/MM/yyyy']
            ],
            [
                'label' => 'auth_key',
                'format' => 'raw',
                'value' => function($data){
                    ($data->auth_key) ? $check = "<i class='glyphicon glyphicon-ok' data-toggle='tooltip' data-placement='right' title='Имеет auth_key'></i>" : $check = "<i class='glyphicon glyphicon-remove'></i>";
                    return $check;

                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
