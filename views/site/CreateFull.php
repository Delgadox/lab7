<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
$this->title = 'CreateQuestion';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($que, 'Question') ?>

            <?php
            echo $form->field($que, 'id')->widget(Select2::classname(), [
                'data' => $ques,
                'options' => ['placeholder' => 'Выберите Вопрос'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>