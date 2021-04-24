<?php

class Firebase
{
    private $team = 'DideShoAPI';
    private $score = '1.0.1';

    public function getPush(string $title, string $message, ? string $image){
        $payload['team'] = $this->team;
        $payload['score'] = $this->score;
        $res = array();
        $res['data']['title'] = $title;
        $res['data']['is_background'] = false;
        $res['data']['message'] = $message;
        $res['data']['image'] = $image;
        $res['data']['payload'] = $payload;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }

    // sending push message to single user by firebase reg id
    public function send($to, $message)
    {
        $fields = [
            'to' => $to,
            'content_available' => true,
            'priority' => "high",
            'data' => $message,
        ];
        return $this->sendPushNotification($fields);
    }

    public function sendIos($to, $message)
    {
        $fields = [
            'to' => $to,
            'content_available' => true,
            'priority' => "high",
            "notification" => [
                "body" => $message['data']['message'],
                "title" => $message['data']['title'],
                "icon" => "appicon"
            ],
            'data' => $message,
        ];
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message)
    {
        $fields = array(
            'to' => '/topics/' . $to,
            'content_available' => true,
            'priority' => "high",
            "notification" => [
                "body" => $message['data']['message'],
                "title" => $message['data']['title'],
                "image" => $message['data']['image'],
                "icon" => "appicon"
            ],
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message)
    {
        $fields = array(
            'registration_ids' => $registration_ids,
            'content_available' => true,
            'priority' => "high",
            'data' => $message,
        );

        return $this->sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields)
    {

        // Set POST variables
        $url = env('FCM_APP_URI', 'https://fcm.googleapis.com/fcm/send');

        $headers = array(
            'Authorization:' . env('FCM_APP_KEY'),
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;

    }

}
// sending push message to single user by firebase reg id only android
function notify(string $to, string $title, string $message, ? string $image)
{

    $firebase = new Firebase();
    $data = $firebase->getPush($title, $message, $image);
    return $firebase->send($to, $data);

}
// sending push message to single user by firebase reg id only ios
function notifyIos(string $to, string $title, string $message, ? string $image)
{

    $firebase = new Firebase();
    $data = $firebase->getPush($title, $message, $image);
    return $firebase->sendIos($to, $data);

}

 // Sending message to a topic by topic name
function notifyAll(string $to, string $title, string $message, ? string $image)
{

    $firebase = new Firebase();
    $data = $firebase->getPush($title, $message, $image);
    return $firebase->sendToTopic($to, $data);

}

// sending push message to multiple users by firebase registration ids
function notifyMultiple(array $multiple, string $title, string $message, ? string $image)
{
    $firebase = new Firebase();
    $data = $firebase->getPush($title, $message, $image);
    return $firebase->sendMultiple($multiple, $data);

}
