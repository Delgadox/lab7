<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
                foreach ($a as $arr)
                {
                echo "<a href=". Url::to(['site/test', 'test' => $arr['id']])."> ".$arr['id'].". ". $arr['Name']. " - " . $arr['Description']. "</a> <br>";
                }
            ?>
        </div>

    </div>
</div>
