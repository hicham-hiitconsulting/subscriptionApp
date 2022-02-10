<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Subscription;
use App\Services\SubscriptionMailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

/**
 * Class MailSubscriber.
 */
class MailSubscriber implements EventSubscriberInterface
{
    //todo create global class for mail

    /**
     * @var SubscriptionMailService
     */
    private $mailService;

    /**
     * MailSubscriber constructor.
     *
     * @param SubscriptionMailService $mailService
     */
    public function __construct(SubscriptionMailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::PRE_WRITE],
        ];
    }

    /**
     * @param ViewEvent $event
     *
     * @throws TransportExceptionInterface
     */
    public function sendMail(ViewEvent $event): void
    {
        $subscription = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$subscription instanceof Subscription || Request::METHOD_POST !== $method) {
            return;
        }
        // $this->mailService->sendEmail($subscription);
    }
}
