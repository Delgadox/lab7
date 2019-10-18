<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAnswersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-answers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Answers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'questions_id',
            'answer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
