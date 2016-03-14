<?php

use yii\helpers\Html;
?>
123
<?= Html::tag('p', Html::encode("框架"), ['class' => 'username']) ?>
<?= Html::tag('p',Html::encode("12"),['class'=>"rrrr",'value'=>333,'id'=>"myid"]) ?>

<?php
$type = 'fail';
$type = "success";$username = 'success';
$options = ['class' => 'btn btn-default'];

if ($type === 'success') {
Html::removeCssClass($options, 'btn-default');
Html::addCssClass($options, 'btn-success');
}

echo Html::tag('div', 'Pwede na', $options);
?>


    type, input name, input value, options
<?= Html::input('text', 'username', $user->name, ['class' => $username]) ?>

    type, model, model attribute name, options
<?= Html::activeInput('text', $user, 'name[]', ['class' => $username]) ?>

<?= Html::beginTag('div',['id'=>null,'checked'=>false]) ?>
这是一个div
<?= Html::endTag('div') ?>

<?= Html::beginForm('','get') ?>

<?= Html::endForm() ?>
