<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $dataProvider array
 * @var $filterModel  dektrium\rbac\models\Search
 * @var $this         yii\web\View
 */


use app\base\widgets\ActionColumn\AdminActionColumn;
use yii\helpers\Url;
use app\base\widgets\GridView\AdminGridView;

$this->title = Yii::t('rbac', 'Roles');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/rbac/views/layout.php') ?>

<?= AdminGridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'name',
            'header' => Yii::t('rbac', 'Name'),
            'options' => ['style' => 'width: 20%'],
            'contentOptions' => ['style' => 'text-align: left'],
            'filterType' => AdminGridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => ['colAlias' => 'name',]
                ],
            ]
        ],
        [
            'attribute' => 'description',
            'header' => Yii::t('rbac', 'Description'),
            'options' => [
                'style' => 'width: 55%'
            ],
            'filterType' => AdminGridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => ['colAlias' => 'description',]
                ],
            ]
        ],
        [
            'attribute' => 'rule_name',
            'header' => Yii::t('rbac', 'Rule name'),
            'options' => [
                'style' => 'width: 20%'
            ],
            'filterType' => AdminGridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => [
                    'ajax' => ['colAlias' => 'rule_name',]
                ],
            ]
        ],
        [
            'class' => AdminActionColumn::className(),
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model) {
                return Url::to(['/rbac/role/' . $action, 'name' => $model['name']]);
            },
            'options' => ['style' => 'width: 5%'],
        ]
    ],
]) ?>

<?php $this->endContent() ?>