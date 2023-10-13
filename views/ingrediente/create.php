<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ingrediente $model */

$this->title = 'Create Ingrediente';
$this->params['breadcrumbs'][] = ['label' => 'Ingredientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingrediente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
