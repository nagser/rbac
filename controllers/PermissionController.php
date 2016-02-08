<?php

namespace nagser\rbac\controllers;

use nagser\base\behaviors\AdminControllerBehavior;
use nagser\rbac\Module;
use omgdef\multilingual\MultilingualQuery;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Json;
use nagser\rbac\models\Permission;

class PermissionController extends \dektrium\rbac\controllers\PermissionController {

	/** @var string */
	protected $modelClass = 'nagser\rbac\models\Permission';

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

    /**
     * Универсальный поиск по любому полю
     * @param string $search
     * @param string $value
     * @param string $colAlias
     * @return Json
     * */
    public function actionSelect2List($search = '', $value = '', $colAlias = 'title')
    {
        /** @var Permission $model * */
        $model = Permission::className();
        /** @var Permission $modelObject * */
        $table = 'auth_item';
        $alias = $colAlias;
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query();
            $query->select('DISTINCT(' . $alias . ') AS id, ' . $alias . ' AS text')
                ->from($table);
            $query->where($alias . ' LIKE "%' . $search . '%"')
                ->andWhere(['type' => '2'])
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