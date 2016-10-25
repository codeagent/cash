<?php
namespace tests\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $tableName = 'users';
    public $dataFile = '@tests/fixtures/data/user.php';
}