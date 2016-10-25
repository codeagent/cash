<?php

/**
 * @var \Faker\Generator $faker
 * @var integer $index
 */

if($index == 0)
    $template = [
        'login'         => 'admin',
        'access_token'  => 'admin',
        'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
        'balance'       => 0.00,
        'is_admin'      => true,
        'created_at'    => time()
    ];
else {
    $name = $faker->name;
    $template = [
        'login'         => $name,
        'access_token'  => $name,
        'password_hash' => Yii::$app->getSecurity()->generatePasswordHash($name),
        'balance'       => 0.00,
        'is_admin'      => false,
        'created_at'    => time() - rand(0, 6 * 31 * 24 * 3600),
    ];
}

return $template;