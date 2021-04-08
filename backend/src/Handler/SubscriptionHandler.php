<?php


namespace App\Handler;

use App\Entity\Subscription;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SubscriptionHandler implements MessageHandlerInterface
{
    public function __invoke(Subscription $subscription)
    {
    }
}