<?php
class CRMApi
{
    public function handleRequest(array $query)
    {
        if(isset($query['action']))
        {
            switch($query['action'])
            {
                case 'newReport':
                    return "New Report: " . file_get_contents('php://input') . "\n";
                    break;

                case 'newOperation':
                    return "New Operation: " . file_get_contents('php://input') . "\n";
                    break;
            }
        }
    }
}

$api = new CRMApi();
file_put_contents(dirname(__DIR__) . '/runtime/logs/crm.log', $api->handleRequest($_GET), FILE_APPEND);