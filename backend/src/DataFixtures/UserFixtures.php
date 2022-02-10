<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Helpers\SecurityHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures.
 */
class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'user-fixture';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * UserFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create('fr_FR');
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadUsers(ObjectManager $manager)
    {
        $roles = [SecurityHelper::ROLE_USER, SecurityHelper::ROLE_ADMIN];

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user
                ->setFirstname($this->faker->firstName)
                ->setLastname($this->faker->lastName)
                ->setEmail($this->faker->email)
                ->setPhone($this->faker->phoneNumber)
                ->setPassword($this->encoder->encodePassword($user, SecurityHelper::PASSWORD))
                ->setRoles([$roles[rand(0, 1)]])
                ->addSubscription(($this->getReference(SubscriptionFixtures::SUBSCRIPTION_REFERENCE.rand(0, 19))))
                ->addPayment(($this->getReference(PaymentDetailsFixtures::PAYMENT_REFERENCE.rand(0, 9))))

                //todo edit and separate admin and user function
;
            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE.$i, $user);
        }
        $manager->flush();
    }
}
