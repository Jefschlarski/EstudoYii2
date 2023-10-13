<?php

/* @var $this \app\common\components\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Um erro ocorreu enquanto o servidor processava sua requisição.
    </p>
    <p>
        Por favor contate o administrador se você acredita que é um erro do servidor. Obrigado.
    </p>

</div>
