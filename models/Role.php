<?php

namespace app\modules\rbac\models;

use Yii;

class Role extends \dektrium\rbac\models\Role {

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