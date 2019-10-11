<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Test';
?>
<div class="site-index">

    <div class="body-content">
<?php
    echo '<div class="test"><div id="question" class="question">'. $questions[0]['Question'] .'</div>';
//    echo '<pre>';
//    print_r($answers);
//    echo '</pre>';
    $a=$answers[$_GET['Question']];
    foreach ($a as $answer){
        print_r($answer);
        echo '<div id="Test'. $answer['id'] .'" onclick="CheckIfRight()" class="TestUnClick">'. $answer['Answer'] .'</div>';
    }
    echo '<br><a href="index">Go back</a></div>';
    echo '<a href="'.Url::to(['site/test', 'test' => $_GET['test'],'Question' => $_GET['Question']+1]) .'">Next</a>';
     ?>

    </div>
</div>
<?php
$script = <<< JS


JS;
$this->registerJs($script);
?>
