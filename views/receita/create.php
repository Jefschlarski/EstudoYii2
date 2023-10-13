<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receita $model */

$this->title = 'Criar Receita';
$this->params['breadcrumbs'][] = ['label' => 'Receitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="receita-create">

    <h1 style="text-align: center; padding: 2rem"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'receita' => $receita,
        'ingredientes' => $ingredientes,
        'ingredientesSelecionados' => $ingredientesSelecionados,
        'quantidades' => $quantidades,
    ]) ?>

</div>