<?php
namespace tests\fixtures;

use yii\test\ActiveFixture;

class OperationFixture extends ActiveFixture
{
    public $tableName = 'operations';
    public $dataFile = '@tests/fixtures/data/operation.php';
    public $depends		= [
        'tests\fixtures\UserFixture'
    ];
}