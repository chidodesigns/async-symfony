<?php
namespace App\Controller;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StockTransactionController extends AbstractController
{
    //  Buy
    #[Route('/buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus):Response
    {

        //$notification->getOrder()->getBuyer()->getEmail()

        //  We are creating an annonymous class
        $order = new class {

            public function getBuyer():object
            {
                return new class {

                    public function getEmail(): string
                    {
                        return 'email@example.tech';
                    }

                };
            }

        };

        //  1. Dispatch Confirmation Message 

        $bus->dispatch(new PurchaseConfirmationNotification($order));

        //  2. Display confirmation to the user
        return $this->render('stocks/example.html.twig');

    }

    //  Sell
}