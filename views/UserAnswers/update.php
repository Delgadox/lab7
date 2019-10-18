<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAnswers */

$this->title = 'Update User Answers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
