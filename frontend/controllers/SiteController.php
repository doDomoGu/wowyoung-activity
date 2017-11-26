<?php
namespace frontend\controllers;

use app\models\Activity;
use app\models\Record;
use frontend\models\RecordForm;
use frontend\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'main_blank';


    public function init(){
        $this->enableCsrfValidation = false;
    }

    public $activity_arr = [
        '2017sh_dreamday_enter' => 1
    ];
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*'error' => [
                'class' => 'yii\web\ErrorAction',
            ],*/
            /*'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $act_name = Yii::$app->request->get('act_name');

        $activity = Activity::find()
            ->where(['status'=>1])
            ->andWhere(['<','start_time',date('Y-m-d H:i:s')])
            ->andWhere(['>','end_time',date('Y-m-d H:i:s')])
            ->all();
        $activity_arr = [];
        $activity_arr2 = [];
        if($activity){
            foreach($activity as $act){
                $activity_arr[] = $act->name;
                $activity_arr2[$act->name] = $act->id;
            }
        }


        if(in_array($act_name,$activity_arr)){

            $this->layout = false;

            return $this->render('../activity/'.$act_name);

            /*$model = new RecordForm();
            if ($model->load(Yii::$app->request->post())) {
                $record = new Record();
                $record->name = $model->name;
                $record->mobile = $model->mobile;
                $record->act_id = $activity_arr2[$act_name];
                $record->add_time = date('Y-m-d H:i:s');
                $request = Yii::$app->request;
                $record->user_ip = $request->getUserIP();
                $record->user_host = $request->getUserHost();
                $record->user_agent = $request->getUserAgent();
                $record->save();

                Yii::$app->session->setFlash('success','报名信息提交成功！');

                return $this->refresh();
            }

            $params['model'] = $model;
            return $this->render('../activity/'.$act_name,$params);*/
        }

        return $this->render('../activity/not_found');
    }

    public function actionError(){
        return $this->render('../activity/not_found');
    }

    public function actionCollection(){
        $message = '提交失败，信息有误！';

        $model = new RecordForm();

        $act_name = Yii::$app->request->post('act_name');

        $activity = Activity::find()
            ->where(['name'=>$act_name])
            ->andWhere(['status'=>1])
            ->andWhere(['<','start_time',date('Y-m-d H:i:s')])
            ->andWhere(['>','end_time',date('Y-m-d H:i:s')])
            ->one();

        if($activity!=NULL){
            $post = [
                'RecordForm'=>[
                    'name'=>Yii::$app->request->post('v1'),
                    'mobile'=>Yii::$app->request->post('v2'),
                ]
            ];
            if ($model->load($post) && $model->validate()) {

                $record = new Record();
                $record->name = $model->name;
                $record->mobile = $model->mobile;
                $record->act_id = $activity->id;
                $record->add_time = date('Y-m-d H:i:s');
                $request = Yii::$app->request;
                $record->user_ip = $request->getUserIP();
                $record->user_host = $request->getUserHost();
                $record->user_agent = $request->getUserAgent();

                if($record->save()){

                    $message = '提交申请成功，谢谢！';
                }else{
                    if($record->hasErrors('mobile')){
                        $message = '请填写正确的11位手机号码!';
                    }
                }
            }else{
                if($model->hasErrors('mobile')){
                    $message = '请填写正确的11位手机号码!';
                }
            }
        }

        echo '<script>alert("'.$message.'");</script>';

        exit;
    }


}
