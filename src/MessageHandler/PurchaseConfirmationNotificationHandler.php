<?php


namespace App\MessageHandler;

use Mpdf\Mpdf;
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
      
        $mpdf = new Mpdf();
        $content = "<h1>Contract Note For Order{$notification->getOrderId()}</h1>";
        $content .= "<p>Total: <b>$1898.75</b></p>";

        $mpdf->WriteHTML($content);
        $contractNotePdf = $mpdf->output('', 'S');

        //  Email the contract note to the buyer
    
        $email = (new Email())
            ->from('sales@stockapp.com')
            ->to('email@example.tech')
            ->subject('Contract note for order ' . $notification->getOrderId())
            ->text('Here is your contract note')
            ->html('<p>Here is your contract note</p>')
            ->attach($contractNotePdf, 'contract-note.pdf');
        

        $this->mailer->send($email);
    }

}