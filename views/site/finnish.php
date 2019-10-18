<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Results';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
                echo 'Кол-во правильных ответов: '.$RightAnswers.'; у пользователя "' . $user['Name']. '"';
            ?>
        </div>

    </div>
</div>
