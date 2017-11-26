<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RecordForm extends Model
{
    public $name;
    public $mobile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'mobile'], 'required','message'=>'不能为空'],
            // email has to be a valid email address
            ['mobile', 'match', 'pattern'=>'/^1[3456789][0-9]{9}$/','message'=>'请输入正确的11位手机号码！'],
            ['mobile', 'unique',  'targetClass' => '\frontend\models\Record', 'targetAttribute' => 'mobile','message'=>'该手机号码已存在！'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '学生姓名',
            'mobile' => '家长手机',
        ];
    }


}
