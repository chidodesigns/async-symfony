<?php

namespace App\MessageHandler\Command;

use App\Message\Command\SaveOrder;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveOrderHandler implements MessageHandlerInterface
{

    public function __invoke(SaveOrder $saveOrder)
    {
        //  Save an order to db 
        $orderId = 123;

        echo 'Order Being Saved' . PHP_EOL;

        //  Dispatch an event message on an event bus

        
    }
    
}
