<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

//$script = <<< JS
//    function CheckIfRight($a,$b) {
//        $.ajax({
//           url: 'http://lab7/web/site/test',
//           data:{answer: $a, question: $b},
//
//           type: 'POST',
//           success: function yes (){
//               alert($a, $b);
//           },
//           error: function no (){
//               alert("SOMETHING WENT WRONG!!!")
//           }
//        });
//    }
//JS;
//$this->registerJs($script);

$this->title = 'Test';
?>
<div class="site-index">

    <div class="body-content">
<?php
    if ($questions == null) {
        echo 'У теста нету вопросов!';
    }elseif ($_GET['Question'] <= (count($questions)-1)){
        echo '<div class="test"><div id="question" class="question">' .$questions[$_GET['Question']]['Question']. '</div>';
        $a = $answers[$_GET['Question']];
        echo '<pre>';
        print_r($questions);
        echo '</pre>';
        foreach ($a as $answer) {

            echo '<div id="Test' . $answer['id'] . '" onclick="CheckIfRight('. $answer['id'] .','.$_GET['Question'].')" class="TestUnClick">' . $answer['Answer'] . '</div>';
        }
        echo '<br><a href="index">Go back</a></div>';
        if (($_GET['Question']) < (count($questions)-1)) {
            echo '<a href="' . Url::to(['site/test', 'test' => $_GET['test'], 'Question' => $_GET['Question'] + 1]) . '">Next</a>';
        }
    }else{
        echo'Такого вопроса нет!';
    }?>

    </div>
</div>
