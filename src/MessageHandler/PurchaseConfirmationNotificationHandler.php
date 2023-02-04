<?php


namespace App\MessageHandler;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//  PHP Attributes: Small meta data elements added for PHP classes, functions, closures, class properties, class methods, constants, and even on anoymous classes. In PHP 8
#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{

    public function __construct(private MailerInterface $mailer)
    {

    }

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        //  Create a PDF contract note
        echo 'Creating a PDF contract note...<br>';
        //  Email the contract note to the buyer
    
        $email = (new Email())
            ->from('sales@stockapp.com')
            ->to($notification->getOrder()->getBuyer()->getEmail())
            ->subject('Contract note for order ' . $notification->getorder()->getId())
            ->text('Here is your contract note')
            ->html('<p>Here is your contract note</p>');
        

        $this->mailer->send($email);
    }

}