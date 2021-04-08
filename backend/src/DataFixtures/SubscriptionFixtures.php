<?php


namespace App\DataFixtures;


use App\Entity\Service;
use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SubscriptionFixtures
 * @package App\DataFixtures
 */
class SubscriptionFixtures extends Fixture
{
    public const SUBSCRIPTION_REFERENCE = 'subscription-fixture';

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadSubscription($manager);
    }

    /**
     * SubscriptionFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');
    }

    /**
     * @param ObjectManager $manager
     */
    public  function loadSubscription(ObjectManager $manager){

        for ($i=0;$i<20;$i++){
            $subscription = new Subscription();
            $subscription->setStartDate($this->faker->dateTimeThisMonth);
            $subscription->setEndDate($this->faker->dateTimeThisYear);
            $subscription->setTitle($this->faker->name);
            $subscription->setStatus($this->faker->boolean);
            $subscription->setService($this->getReference(ServiceFixtures::SERVICE_REFERENCE.rand(0,4)));

            $manager->persist($subscription);
            $this->addReference(self::SUBSCRIPTION_REFERENCE.$i, $subscription);

        }
        $manager->flush();

    }
}