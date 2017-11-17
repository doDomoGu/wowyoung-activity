<?php
return [
    'components' => [
        'db' => require 'db-local.php',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
