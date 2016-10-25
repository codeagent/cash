<?php
use app\models\Article;
/**
 * @var \Faker\Generator $faker
 * @var integer $index
 */


$isForUser = $faker->randomElement([false, true]);
return [
    'amount'      => $faker->randomFloat(2, 100, 100000),
    'is_debit'    => $faker->randomElement([0, 1]),
    'is_for_user' => $isForUser,
    'user_id'     => $isForUser ? ($index % 10) + 2 : null,
    'comment'     => $faker->sentence(),
    'created_at'  => time() - rand(0, 6 * 31 * 24 * 3600),
];