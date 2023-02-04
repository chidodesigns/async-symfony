<?php


namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//  PHP Attributes: Small meta data elements added for PHP classes, functions, closures, class properties, class methods, constants, and even on anoymous classes. In PHP 8
#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        //  Create a PDF contract note
        echo 'Creating a PDF contract note...<br>';
        //  Email the contract note to the buyer
        echo 'Emailing contract note to ' .  $notification->getOrder()->getBuyer()->getEmail() . '<br>';
    }

}