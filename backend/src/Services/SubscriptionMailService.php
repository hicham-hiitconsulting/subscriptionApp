<?php


namespace App\Services;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;


/**
 * Class SubscriptionMailService
 * @package App\Services
 */
class SubscriptionMailService
{

    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * SubscriptionMailService constructor.
     * @param MailerInterface $mailer
     * @param UserRepository $userRepository
     */
    public function __construct(MailerInterface $mailer,UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Subscription $subscription
     * @throws TransportExceptionInterface
     */
    public function sendEmail(Subscription $subscription)
    {

    //$subscriber=    $this->userRepository->find($subscription->getSubscriber());
    //todo check if subscriber is null
        $subscriber = $subscription->getSubscriber();

      $email = (new TemplatedEmail())
            ->from('support@hiitconsulting.com')
            ->to()
            ->subject('Subscription Activated')
            ->htmlTemplate('emails/notify_client.html.twig')
            ->context([
                'first_name' => $subscription->getSubscriber()->getFirstname(),
                'start_date' => $subscription->getStartDate()->format('Y-m-d'),
                'end_date' => $subscription->getEndDate()->format('Y-m-d')

            ])
        ;

            $this->mailer->send($email);


    }


}