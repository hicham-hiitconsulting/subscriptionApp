<?php

namespace App\Services;

use App\Entity\Service;
use App\Entity\User;

/**
 * Class SubscriptionChecker.
 */
class SubscriptionChecker
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function isUserHaveSubscription(User $user): bool
    {
        if ($user->getSubscriptions()->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isSubscriptionExpired(User $user): bool
    {
        foreach ($user->getSubscriptions() as $sub) {
            if ($sub->getEndDate() > new \DateTime('now')) {
                return true;
            }
        }

        return  false;
    }

    /**
     * @param User $user
     *
     * @return Service|null
     */
    public function getUserSubscriptionService(User $user): ?Service
    {
        foreach ($user->getSubscriptions() as $sub) {
            return $sub->getService();
        }
    }
}
