<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receita $receita */

$this->title = 'Editar ' . $receita->nome;
$this->params['breadcrumbs'][] = ['label' => 'Receitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $receita->id, 'url' => ['view', 'id' => $receita->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="receita-update">

    <h1 style="text-align: center;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'receita' => $receita,
        'ingredientes' => $ingredientes,
        'ingredientesSelecionados' => $ingredientesSelecionados,
        'quantidades' => $quantidades,
    ]) ?>

</div>