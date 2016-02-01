<?php

namespace nagser\rbac;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface {

    public function bootstrap($app){
        //Загрузка языков
        if (!isset($app->get('i18n')->translations['rbac'])) {
            $app->get('i18n')->translations['rbac'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/vendor/nagser/rbac/messages',
                'fileMap' => ['rbac' => 'rbac.php']
            ];
        }
    }

}