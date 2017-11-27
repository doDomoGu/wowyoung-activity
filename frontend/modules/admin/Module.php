<?php

namespace frontend\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\admin\controllers';
    public $layout = 'main';
    public $defaultRoute = 'site';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here

        $this->setComponents([
            'adminUser' => [
                'class'=>'yii\web\User',
                'identityClass' => 'frontend\modules\admin\models\AdminUserIdentity',
                'identityCookie'=> ['name' => '_admin_identity', 'httpOnly' => true],
                'idParam' => '__admin',  //需要配置前缀，与前台用户session区分
                'enableAutoLogin' => true,
                'loginUrl'=>'/admin/site/login'
            ],

        ]);
    }
}
