<?php

use yii\widgets\LinkPager;
$this->title = '活动数据';

?>
<div>
    <a class="btn btn-success" target="_blank" href="/admin/site/export">导出</a>
    <br/>
    <br/>
</div>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>学生姓名</th>
        <th>手机号码</th>
        <th>申请时间</th>
        <th>IP地址</th>
        <!--<th>设备代理</th>-->
    </tr>
<?php $i = $pages->pageSize * $pages->page;?>
<?php foreach($list as $key=>$val){ ?>
<?php $i++;?>
    <tr>
        <td><?=$i?></td>
        <td><?=$val->name?></td>
        <td><?=$val->mobile?></td>
        <td><?=$val->add_time?></td>
        <td><?=$val->user_ip?></td>
        <!--<td><?/*=$val->user_agent*/?></td>-->
    </tr>
<?php } ?>
</table>
<div class="text-center">
<?=
LinkPager::widget([
    'pagination' => $pages,
]);
?>
</div>


<!--<div class="row">
    <div class="col-md-6">
        <div class="col-md-6 col-xs-12 col-sm-6">
            <div class="well">
                <div class="value"><?/*=$user_count*/?></div>
                <div class="title">注册玩家</div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6">
            <div class="well">
                <div class="value"><?/*=$room_count*/?></div>
                <div class="title">正在游玩的房间</div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6">
            <div class="well">
                <div class="value"><?/*=$game_count*/?></div>
                <div class="title">历史游戏总局数</div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6">
            <div class="well">
                <div class="value"><?/*=$record_count*/?></div>
                <div class="title">历史游戏操作数</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>-->