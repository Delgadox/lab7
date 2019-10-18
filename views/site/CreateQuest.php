<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
$this->title = 'CreateQuest';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php $form = ActiveForm::begin(); ?>

            <?php
                echo $form->field($test, 'id')->widget(Select2::classname(), [
                    'data' => $tests,
                    'options' => ['placeholder' => 'Выберите котёл'],
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