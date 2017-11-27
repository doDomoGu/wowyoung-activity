<?php
namespace frontend\modules\admin\controllers;

use frontend\models\Record;
use frontend\modules\admin\models\AdminLoginForm;
use Yii;
use yii\data\Pagination;

class SiteController extends BaseController{

    public function actionIndex()
    {
        $act_id = 1;

        $record = Record::find()->where(['act_id'=>$act_id])->orderBy('add_time desc');


        $pages = new Pagination(['totalCount' =>$record->count(), 'pageSize' => '20']);
        $list = $record->offset($pages->offset)->limit($pages->limit)->all();

        $params['list'] = $list;
        $params['pages'] = $pages;

        return $this->render('index',$params);
    }


    public function actionExport(){
        ob_start();
        header("Content-type: text/html; charset=utf-8");

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName("微软雅黑")->setSize(10)->setBold(true);
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


        $objSheet = $objPHPExcel->getActiveSheet();

        $objSheet->getColumnDimension('A')->setWidth(8);
        $objSheet->getColumnDimension('B')->setWidth(8);
        $objSheet->getColumnDimension('C')->setWidth(30);
        $objSheet->getColumnDimension('D')->setWidth(20);
        $objSheet->getColumnDimension('E')->setWidth(20);

        $objSheet->setCellValue('A1','#');
        $objSheet->setCellValue('B1','学生姓名');
        $objSheet->setCellValue('C1','手机号码');
        $objSheet->setCellValue('D1','申请时间');
        $objSheet->setCellValue('E1','IP地址');
        $act_id = 1;
        $list = Record::find()->where(['act_id'=>$act_id])->orderBy('add_time desc')->all();
        $i = 0;
        foreach($list as $l){
            $i++;
            $objSheet->setCellValue('A'.($i+1),$i);
            $objSheet->setCellValue('B'.($i+1),$l->name);
            $objSheet->setCellValue('C'.($i+1),$l->mobile);
            $objSheet->setCellValue('D'.($i+1),$l->add_time);
            $objSheet->setCellValue('E'.($i+1),$l->user_ip);
        }

        //exit;

        ob_end_clean();
        //ob_clean();

        header('Content-Type: application/vnd.ms-excel');
        $filename = 'wowyoung_activity_'.date('Y-m-d_H:i:s');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function actionLogin(){

        $this->layout =false;
        if (!$this->module->adminUser->isGuest) {
            return $this->redirect('/admin');
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session = Yii::$app->session;
            if(isset($session['referrer_url_admin']))
                return $this->redirect($session['referrer_url_admin']);
            else
                return $this->redirect('/admin');
        }

        $viewName = 'login';
        return $this->render($viewName, [
            'model' => $model,
        ]);
    }

    public function actionLogout(){
        $this->module->adminUser->logout();
        return $this->redirect('/admin');
    }

    public function actionError(){
        return $this->render('error');
    }
}