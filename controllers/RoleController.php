<?php

namespace app\modules\rbac\controllers;

use app\base\behaviors\CustomAdminControllerBehavior;
use app\modules\rbac\Module;
use yii\filters\AccessControl;

class RoleController extends \dektrium\rbac\controllers\RoleController {

	/** @var string */
	protected $modelClass = 'app\modules\rbac\models\Role';

	public function behaviors(){
		return [
			'controller' => [
				'class' => CustomAdminControllerBehavior::className(),
				'module' => Module::className()
			],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['rbac-role-admin-index']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['rbac-role-admin-create']
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['rbac-role-admin-update']
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['rbac-role-admin-delete']
                    ],
                ]
            ]
		];
	}

}