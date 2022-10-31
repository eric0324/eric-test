<?php

namespace App\Services;

use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService {

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function send_notification($data) {

        $messaging = app('firebase.messaging');

        $message = CloudMessage::withTarget('token', data_get($data, 'deviceId'))
                               ->withNotification(Notification::create('Incoming message', data_get($data, 'text')));

        $messaging->send($message);
    }
}
