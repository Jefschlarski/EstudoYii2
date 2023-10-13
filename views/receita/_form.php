<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Receita $receita */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="receita-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="div-campos" style="display:flex; justify-content:center; align-items:center;">
    <?= $form->field($receita, 'nome')->textInput(['maxlength' => true], ['autocomplete' => 'off']) ?>
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success button-salvar']) ?>
    </div>
    <?php if (empty($ingredientes)) : ?>
        <h5>Não há ingredientes cadastrados.</h5>
    <?php else : ?>
        <div class="ingredient-section">
            <?php foreach ($ingredientes as $ingrediente) : ?>
                <div class="ingredient-item container">
                    <div style="display: flex; flex-direction:column">
                        <?= Html::label($ingrediente->nome, null, ['class' => 'ingredient-label']) ?>
                        <?= Html::checkbox('ingredientes[]', in_array($ingrediente->id, $ingredientesSelecionados) && ($quantidades[$ingrediente->id] ?? 0) > 0, ['value' => $ingrediente->id,  'class' => 'ingredient-checkbox']) ?>
                        <div class="input-group">
                            <button type="button" class="decrementar" onclick="decrementar(<?= $ingrediente->id ?>)">-</button>
                            <input type="text" style="text-align: center;" onload="desativar(<?= $ingrediente->id ?>) " name="quantidade[<?= $ingrediente->id ?>]" min="0" value="<?= $quantidades[$ingrediente->id] ?? 0 ?>" class="ingredient-quantity">
                            <button type="button" class="incrementar" onclick="incrementar(<?= $ingrediente->id ?>)">+</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>

<style>
    .div-campos {
        padding:2em
    }
    .div-campos :nth-child(1){
        width:500px
    }
    .help-block{
        position:absolute;
    }
    .button-salvar{
        height:38px;
        position:relative;
        top:8px;
        right:5px
    }
    .receita-header {
        display: flex;
        width: 100%;
        height: 40px;
        justify-content: space-around;
    }

    .btn-submit {
        display: flex;
        position: relative;
        top: -54px;
        justify-content: end;
    }

    .btn-submit :first-child {
        width: 120px;
    }



    .ingredient-section {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .ingredient-item {
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        width: 120px
    }



    .ingredient-item div {
        text-align: center;
        color: black;
        font-size: 20px;
        font-weight: 400;
    }


    .input-group :nth-child(1) {
        user-select: none;
        background-color: #edebeb;
        width: 30px;
        height: 40px;
        border-color: black;
        border-bottom-left-radius: 5px;
        border-right: none;
        border-style: solid;
        border-width: 0.5px;
        transition: 0.5s;
    }


    .input-group :nth-child(2) {
        user-select: none;
        width: 30px;
        height: 40px;
        border-color: black;
        border-left: none;
        border-right: none;
        border-width: 0.5px;
        pointer-events: none;

    }

    .input-group :nth-child(3) {
        user-select: none;
        background-color: #edebeb;
        width: 30px;
        height: 40px;
        border-color: black;
        border-bottom-right-radius: 5px;
        border-left: none;
        border-style: solid;
        border-width: 0.5px;
        transition: 0.5s;
    }

    .input-group :nth-child(1):hover {
        background-color: #f21d1d;
    }

    .input-group :nth-child(3):hover {
        background-color: #1d68f2;
    }

    .ingredient-checkbox {
        pointer-events: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 90px;
        height: 10px;
        position: relative;
        top: 0px;
        border: 0.5px solid black;
        border-bottom: none;
        border-radius: 0px;
        outline: none;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        background-color: red;
    }

    .ingredient-checkbox:checked {
        background-color: green;
    }

    .ingredient-checkbox:not(:checked)+.input-group .decrementar,
    .ingredient-checkbox:not(:checked)+.input-group .incrementar {
        background-color: white;
    }
</style>

<script>

function desativar(id) {
        var quantidadeInput = document.getElementsByName('quantidade[' + id + ']')[0];
        var checkbox = document.getElementsByName('ingredientes[]')[id - 1];
        checkbox.disabled = (parseInt(quantidadeInput.value) === 0);
        
        quantidadeInput.addEventListener('input', function() {
            checkbox.disabled = (parseInt(this.value) === 0);
        });
    }
    
    function incrementar(id) {
        var input = document.querySelector('input[name="quantidade[' + id + ']"]');
        var valor = parseInt(input.value);
        input.value = valor + 1;

        var checkbox = document.querySelector('input[value="' + id + '"].ingredient-checkbox');
        checkbox.checked = true;
    }

    function decrementar(id) {
        var input = document.querySelector('input[name="quantidade[' + id + ']"]');
        var valor = parseInt(input.value);

        if (valor > 0) {
            input.value = valor - 1;
            var checkbox = document.querySelector('input[value="' + id + '"].ingredient-checkbox');
            checkbox.checked = (valor - 1) > 0; // Desmarcar apenas se valor-1 for maior que 0
        } else {
            var checkbox = document.querySelector('input[value="' + id + '"].ingredient-checkbox');
            checkbox.checked = false;
        }
    }
</script>