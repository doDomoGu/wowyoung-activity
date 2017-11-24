<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "record".
 *
 * @property int $id
 * @property int $act_id
 * @property string $name
 * @property string $mobile
 * @property string $add_time
 * @property string $user_ip
 * @property string $user_agent
 * @property string $user_host
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_id', 'name', 'mobile', 'add_time'], 'required'],
            [['act_id'], 'integer'],
            [['add_time'], 'safe'],
            [['name', 'mobile'], 'string', 'max' => 20],
            [['user_ip', 'user_agent', 'user_host'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'act_id' => 'Act ID',
            'name' => '学生姓名',
            'mobile' => '家长手机',
            'add_time' => 'Add Time',
            'user_id' => 'User IP',
            'user_agent' => 'User Agent',
            'user_host' => 'User Host',
        ];
    }
}
