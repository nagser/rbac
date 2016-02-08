<?php

namespace nagser\rbac\controllers;

use nagser\rbac\models\Role;
use nagser\rbac\Module;
use nagser\base\behaviors\AdminControllerBehavior;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Json;

class RoleController extends \dektrium\rbac\controllers\RoleController {

	/** @var string */
	protected $modelClass = 'nagser\rbac\models\Role';

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
                        'actions' => ['index', 'select2-list'],
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

    /**
     * Универсальный поиск по любому полю
     * @param string $search
     * @param string $value
     * @param string $colAlias
     * @return Json
     * */
    public function actionSelect2List($search = '', $value = '', $colAlias = 'title')
    {
        /** @var Role $model * */
        $model = Role::className();
        /** @var Role $modelObject * */
        $table = 'auth_item';
        $alias = $colAlias;
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query();
            $query->select('DISTINCT(' . $alias . ') AS id, ' . $alias . ' AS text')
                ->from($table);
            $query->where($alias . ' LIKE "%' . $search . '%"')
                ->andWhere(['type' => 1])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($value > 0) {
            $out['results'] = ['id' => $value, 'text' => $model::find($value)->$colAlias];
        }
        return Json::encode($out);
    }

}