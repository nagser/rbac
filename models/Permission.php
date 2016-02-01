<?php

namespace app\modules\rbac\models;

use Yii;

class Permission extends \dektrium\rbac\models\Permission {

    public function attributeLabels()
    {
       return [
           'name' => Yii::t('rbac', 'Name'),
           'description' => Yii::t('rbac', 'Description'),
           'rule' => Yii::t('rbac', 'Rule'),
           'children' => Yii::t('rbac', 'Children'),
       ];
    }

}