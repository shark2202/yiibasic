<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php if($message){ ?>
    <?= Html::encode($model->name) ?>
    <?= Html::encode($model->email) ?>
<?php }else{?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
<?php }?>
