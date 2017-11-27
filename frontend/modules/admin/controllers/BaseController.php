<?php
namespace frontend\modules\admin\controllers;

//use frontend\modules\admin\components\AdminFunc;
use Yii;
use yii\web\Controller;
//use app\components\CommonFunc;

class BaseController extends Controller
{
   /* public $user = false;
    public $isInRoom = false;
    public $roomId = false;
    public $navItems = [];*/


    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->checkLogin();
        return true;
    }

    public function checkLogin(){
        //除“首页”和“登陆页面”以外的页面，需要进行登陆判断
        if(!in_array($this->route,array('admin/site/login','admin/site/captcha','admin/site/error','admin/site/logout'))){
            if($this->module->adminUser->isGuest){
                $session = Yii::$app->session;
                $session['referrer_url_admin'] = Yii::$app->request->getAbsoluteUrl();
                $this->redirect(Yii::$app->urlManager->createUrl($this->module->adminUser->loginUrl));
                Yii::$app->end();
            }
        }
        return true;
    }
}