<?php
namespace app\components;

use yii\base\Component;

use app\models\Report;
use app\models\Operation;

class CrmNotifier extends Component
{
    public $apis = [
        'newReport'    => 'http://crm.example.com/?action=newReport',
        'newOperation' => 'http://crm.example.com/?action=newOperation'
    ];

    public function newReport(Report $report)
    {
        return $this->makeRequest($this->apis['newReport'], $report->toArray());
    }

    public function newOperation(Operation $operation)
    {
        return $this->makeRequest($this->apis['newOperation'], $operation->toArray());
    }

    protected function makeRequest($url, array $data)
    {
        $json_data = json_encode($data);
        $curl      = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_data)]
        );
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}