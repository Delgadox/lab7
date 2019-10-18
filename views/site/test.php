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
// Проверка на юзера
if ($_SESSION['user']){
    if (!$flag){
       $ansid = $useranswers[$_SESSION['user']][$questions[$_GET['Question']]['id']];
// Проверка на отсутствие вопросов
            if ($questions == null) {
                echo 'У теста нету вопросов!';
// Если ГЕТ параметр меньше или равен кол-ва вопросов. Чтобы не было вывода лишних вопросов
            } elseif ($_GET['Question'] <= (count($questions) - 1)) {

                echo '<div class="test"><div id="question" class="question">' . $questions[$_GET['Question']]['Question'] . '</div>';
                $a = $answers[$_GET['Question']];
                foreach ($a as $answer) {
                    echo '<div id="Test' . $answer['id'] . '" onclick="CheckIfRight(' . $answer['id'] . ',' . $questions[$_GET['Question']]['id'] . ',' . $_SESSION['user'] . ')" class="TestUnClick">' . $answer['Answer'] . '</div>';
                }
                if ($_GET['Question'] != 0){
                    echo '<a href="' . Url::to(['site/test', 'test' => $_GET['test'], 'Question' => $_GET['Question'] - 1]) . '">Back</a> <br>';
                }
// Если ГЕТ параметр меньше кол-ва вопросов. Чтобы не появилась кнопка "NEXT" если след вопроса нет
            } else {
                echo 'Такого вопроса нет!';
            }
        }else{
            echo '<div class="test"><div id="question" class="question">' . $questions[$_GET['Question']]['Question'] . '</div> <div>Вы уже ответели на этот вопрос.</div>';
        }
        if (($_GET['Question']) < (count($questions) - 1)) {
            echo '<a href="' . Url::to(['site/test', 'test' => $_GET['test'], 'Question' => $_GET['Question'] + 1]) . '">Next</a>';
        }else{
            echo '<a href="' . Url::to(['site/finnish', 'test' => $_GET['test']]) . '">Finnish</a>';
        }
    }else{
        echo '<a href="'.Url::to(['users', 'test' => $_GET['test'], 'Question' => $_GET['Question']]).'" >Необходимо выбрать пользователя!</a>';
    }
    ?>

    </div>
</div>
