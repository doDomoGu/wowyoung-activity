<?php
use frontend\assets\AppAsset;
use yii\bootstrap\ActiveForm;

AppAsset::addCssFile($this,'css/activity.css');

?>

<section id="mainpage">
    <div class="title">
        我样 · 2017上海国际学校梦想日报名通道（12/09周六）
    </div>
    <div class="page-description">
        <p><strong>时间：</strong>2017年12月9日（周六）9:00—12:00（8:30起凭短信入场）</p>

        <p><strong>地点：</strong>上海静安&nbsp;·&nbsp;浦西洲际酒店3楼（恒丰路500号，近天目西路）</p>

        <p><strong>交通：</strong>地铁1号线上海火车站站（3号口）</p>

        <p><strong>参加对象：</strong>上海及长三角初中和小学家庭，有意向报考国际高中或双语中小学</p>

        <p><strong>精彩内容：</strong>1对1学校咨询（50所国际学校一次逛完）&nbsp;+ 名校招生官现场讲解</p>

        <p><strong>特别提醒：</strong>活动组委会将在活动前3天内发送确认短信，当日凭短信签到入场！</p>

        <p>报名完成后即可限时免费领取2-10年纪国际学校入学测评卷（数学+英语）！</p>
    </div>

    <div class="page-form">

        <?php $form = ActiveForm::begin(['id' => 'enter-form'/*,'layout'=>'inline'*/]); ?>

        <?= $form->field($model, 'name')->label(false)->textInput(['autofocus' => true,'placeholder'=>'学生姓名']) ?>

        <?= $form->field($model, 'mobile')->label(false)->textInput(['placeholder'=>'家长手机']) ?>

        <div class="form-group">
            <?= \yii\bootstrap\Html::submitButton('报名提交', ['class' => 'btn btn-primary submit-btn', 'name' => 'submit-button']) ?>
            <?php $session = Yii::$app->session;
            $success = $session->get('success');
            if($success){
                echo '<span class="alert-success">'.$success.'</span>';
                $session->removeFlash('success');
            }

            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>