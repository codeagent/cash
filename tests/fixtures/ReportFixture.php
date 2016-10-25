<?php
namespace tests\fixtures;

use yii\test\ActiveFixture;

class ReportFixture extends ActiveFixture
{
    public $tableName = 'reports';
    public $dataFile = '@tests/fixtures/data/report.php';
    public $depends		= [
        'tests\fixtures\UserFixture'
    ];
}