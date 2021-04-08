<?php


namespace App\EventListener;

use App\Entity\User;
use App\Services\SubscriptionChecker;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

/**
 * Class AuthenticationSuccessListener
 * @package App\EventListener
 */
class AuthenticationSuccessListener
{

    /**
     * @var SubscriptionChecker
     */
    private $subscriptionCheck;

    /**
     * AuthenticationSuccessListener constructor.
     * @param SubscriptionChecker $subscriptionChecker
     */
    public function __construct( SubscriptionChecker  $subscriptionChecker)
    {

        $this->subscriptionCheck = $subscriptionChecker;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        //todo remove condition and create exceptions
        //case 1 : if User don't have a subscription
        if($this->subscriptionCheck->isUserHaveSubscription($user)==false){
            $data['error'] = "User have not a subscription yet please contact the admin";
        }else
        //case 2: if the User subscription is due
        if($this->subscriptionCheck->isSubscriptionExpired($user) == true){
            $data['error'] = "Subscription Expired";

        }else{
            //case 3 : return user subscription with service
            $userService = $this->subscriptionCheck->getUserSubscriptionService($user);
            $data['service_name'] = $userService->getName();
            $data['service_url'] = $userService->getUrl();

        }

        $event->setData($data);
    }
}