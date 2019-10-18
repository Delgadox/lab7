<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAnswers */

$this->title = 'Create User Answers';
$this->params['breadcrumbs'][] = ['label' => 'User Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-answers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
