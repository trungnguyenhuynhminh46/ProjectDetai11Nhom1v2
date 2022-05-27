<?php
require 'vendor/autoload.php';
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

function sendMessage($MessageBody, $url){
    $client = new SqsClient([
        'profile' => 'default',
        'region' => 'us-east-1',
        'version' => '2012-11-05'
    ]);

    $params = [
        'MessageBody' => $MessageBody,
        'QueueUrl' => $url
    ];

    try {
        $result = $client->sendMessage($params);
    } catch (AwsException $e) {
        // output error message if fails
        error_log($e->getMessage());
    }
}

function receiveAndDeleteMessage($url){
    $client = new SqsClient([
        'profile' => 'default',
        'region' => 'us-east-1',
        'version' => '2012-11-05'
    ]);
    try {
        $result = $client->receiveMessage(array(
            'AttributeNames' => ['All'],
            'MaxNumberOfMessages' => 1,
            'MessageAttributeNames' => ['All'],
            'QueueUrl' => $url,
            'WaitTimeSeconds' => 0,
        ));
        if (!empty($result->get('Messages'))) {
            $res = $result->get('Messages')[0];
            $client->deleteMessage([
                'QueueUrl' => $url,
                'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle']
            ]);
            return $res;
        } else {
            echo "No messages in queue. \n";
        }
    } catch (AwsException $e) {
        // output error message if fails
        error_log($e->getMessage());
    }
}
?>