<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \app\models\Country;
?>
Html::beginForm的第一个参数会给Url::to处理
<?= Html::beginForm(["hello/goback",'id'=>123],'post',['id'=>100]) ?>

<?= Html::tag("br")?>
下面是input，第一个参数是类型type，第二是是否name，第三个就是value，第四个是选项
<?= Html::tag("br")?>
<?= Html::input('text',"name1","this is value",['id'=>'name_id']) ?>

<?= Html::tag("br")?>
下面是radio，第一个参数是name，第二是是否checked，第三个中的键value对应的就是value值
<?= Html::tag("br")?>
<?= Html::radio('agree', false, ['label' => 'I agree','value'=>100]);?>
<?= Html::radio('agree', true, ['label' => 'I NOT agree','value'=>222]);?>
<?= Html::radioList('checkbox1[]',$currentUserId, ArrayHelper::map($userModels, 'code', 'name')) ?>

<?= Html::tag("br")?>
下面是checkbox多选框，第一个参数是name，第二个是是否选中checked,第三个中的键value就是value值
<?= Html::tag("br")?>
<?= Html::checkbox('agree2[]', true, ['label' => 'I agree','value'=>12]); ?>
<?= Html::checkbox('agree2[]', true, ['label' => 'I NOT agree','value'=>234]); ?>
<?= Html::checkboxList('checkbox1[]',[$currentUserId,"UN"], ArrayHelper::map($userModels, 'code', 'name')) ?>

<?= Html::tag("br")?>
下面是radio多选框，第一个参数是模型，第二个是名称,第三个是选项
<?= Html::tag("br")?>
<?= Html::activeRadio($model, 'name', ['class' => 'agreement']) ?>
<?= Html::tag("br")?>
使用activeRadioList,第一个是模型，第二个是模型属性名称，第三个是选项列表[key=>value],选中的值就是模型对应的属性的值,第四个参数中的name键会覆盖模型的属性值
<?= Html::activeRadioList($model,'code',Country::find()->select(['name','code'])->indexBy('code')->column(),['name'=>'code[123]']) ?>

<?= Html::tag("br")?>
下面是下拉框select,第一个参数是name，第二个是选中的值selected,第三个是option对应的键和值
<?= Html::tag("br")?>
<?= Html::dropDownList('list', $currentUserId, ArrayHelper::map($userModels, 'code', 'name')) ?>
<?= Html::dropDownList('list3', null, ArrayHelper::map($userModels, 'code', 'name'),['prompt'=>"请选择..."]) ?>

<?= Html::tag("br")?>
下面是也是一个下拉框select,第一个参数是name，第二个是选中的值selected,第三个是option对应的键和值
<?= Html::tag("br")?>
<?= Html::listBox('list2', $currentUserId, ArrayHelper::map($userModels, 'code', 'name'),['size'=>10]) ?>

<?= Html::tag("br")?>
下面按钮
<?= Html::tag("br")?>
<?= Html::submitInput("提交") ?>
<?= Html::resetInput("重置input") ?>
<?= Html::resetButton("重置button") ?>
<?= Html::submitButton("提交button") ?>
<?= Html::endForm() ?>

<?= Html::tag("br")?>
    下面是另一个form表单 ActiveForm
<?= Html::tag("br")?>
<?php $form2 = ActiveForm::begin(); ?>
<?= $form2->field($model, '[1]name') ?>
<?= $form2->field($model, '[2]name') ?>
<?= $form2->field($model,'code')->passwordInput()?>

<?= Html::tag("br")?>
下面是一个下拉列表
<?= Html::tag("br")?>
<?= $form2->field($model,'code[]')->dropdownList(
    Country::find()->select(['name','code'])->indexBy('code')->column(),
    ['prompt'=>"请选择"]
) ?>

<?= Html::tag("br")?>
下面是另一个radio,还是调用Html::activeRadioList(),前面的field()的参数会传到到它,radioList的参数是一组键值对[key-value]
<?= Html::tag("br")?>
<?= $form2->field($model,'code')->radioList(
    Country::find()->select(['name','code'])->indexBy('code')->column(),['name'=>'code[456]']
) ?>
<?= Html::tag("br")?>
下面是另一个droplist,还是调用Html::activeRadioList(),前面的field()的参数会传到到它,radioList的参数是一组键值对[key-value]
<?= $form2->field($model,'code')->dropDownList(Country::find()->select(['name','code'])->indexBy('code')->column(),['name'=>"code[333]",'prompt'=>"我要选择！"])?>
<?= Html::submitInput("提交") ?>
<?php ActiveForm::end() ?>

<?= Html::tag("br")?>
下面是js 代码
<?= Html::tag("br")?>
<?= Html::script(<<<EOF
//这个里面是javascript代码
alert("{$currentUserId}");
console.log("{$model->code}");
EOF
)?>
