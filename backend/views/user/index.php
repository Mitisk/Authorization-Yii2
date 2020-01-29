<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Пользователи сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <?= Html::a('Создать нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body table-responsive p-0">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [

                'id',
                [
                    'attribute'=> 'username',
                    'format' => 'raw',
                    'value' => function($data){
                        if ($username = $data->username) {
                            $username = $data->username;
                        } else {$username = '(не задано)';}

                        if ($data->auth->source_id) {
                            $url = 'https://vk.com/id'.$data->auth->source_id;
                            $vk = ' ('.Html::a('ВКонтакте', \yii\helpers\Url::to($url, true), $options = ['target' => 'blank']).')';
                        } else {$vk = '';}

                        return $username . $vk;
                    },
                ],
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
                        ($data->auth_key) ? $check = "<i class='fas fa-check' data-toggle='tooltip' data-placement='right' title='Имеет auth_key'></i>" : $check = "<i class='fas fa-times'></i>";
                        return $check;
                    },
                ],

                ['class' => ActionColumn::className(),
                    //'template' => '{details} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'title' => 'Full Details',
                                'data-pjax' => '0',
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-pencil"></i>', $url, [
                                'title' => 'Edit',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => 'Are you sure you want to delete?',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                    ],]
            ],
        ]); ?>
    </div>
</div>



