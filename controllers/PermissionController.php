<?php

namespace nagser\rbac\controllers;

use nagser\base\behaviors\AdminControllerBehavior;
use nagser\rbac\Module;
use yii\filters\AccessControl;

class PermissionController extends \dektrium\rbac\controllers\PermissionController {

	/** @var string */
	protected $modelClass = 'app\modules\rbac\models\Permission';

	public function behaviors(){
		return [
			'controller' => [
				'class' => AdminControllerBehavior::className(),
				'module' => Module::className()
			],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['rbac-permission-admin-index']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['rbac-permission-admin-create']
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['rbac-permission-admin-update']
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['rbac-permission-admin-delete']
                    ],
                ],
            ]
		];
	}

}