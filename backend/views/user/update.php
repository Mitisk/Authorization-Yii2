<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBehavior */

$this->title = 'Редактирование пользователя id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-behavior-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'methodToPass' => 'update',
    ]) ?>

</div>