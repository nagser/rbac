<?php

/**
 * @var $this  yii\web\View
 * @var $model dektrium\rbac\models\Role
 */

use nagser\base\widgets\Select2\Select2;
use nagser\base\widgets\ActiveForm\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'description') ?>
<?= $form->field($model, 'rule') ?>
<?= $form->field($model, 'children')->widget(Select2::className(), [
    'data' => $model->getUnassignedItems(),
    'options' => [
        'id' => 'children',
        'multiple' => true
    ],
]) ?>
<?= Html::submitButton(Yii::t('rbac', 'Save'), ['class' => 'btn btn-default']) ?>

<?php ActiveForm::end() ?>