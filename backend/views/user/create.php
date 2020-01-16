<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBehavior */

$this->title = 'Создание нового пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-behavior-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'methodToPass' => 'create',
    ]) ?>

</div>