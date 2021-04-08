<?php


namespace App\Services;

use App\Entity\Subscription;
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
     * SubscriptionMailService constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Subscription $subscription
     * @throws TransportExceptionInterface
     */
    public function sendEmail(Subscription $subscription)
    {
      $email = (new TemplatedEmail())
            ->from('support@hiitconsulting.com')
            ->to($subscription->getSubscriber()->getEmail())
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