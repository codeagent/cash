<?php

use app\models\Article;

/**
 * @var \Faker\Generator $faker
 * @var integer $index
 */


return [
    'user_id'    => ($index % 10) + 2,
    'amount'     => $faker->randomFloat(2),
    'created_at' => time() - rand(0, 6 * 31 * 24 * 3600),
    'article'    => $faker->randomElement(array_keys(Article::getCatalog()))
];