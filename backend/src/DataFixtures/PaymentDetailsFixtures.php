<?php


namespace App\DataFixtures;


use App\Entity\PaymentDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class PaymentDetailsFixtures
 * @package App\DataFixtures
 */
class PaymentDetailsFixtures extends Fixture
{
    public const PAYMENT_REFERENCE = 'payment-fix';

    /**
     * @var Generator
     */
    private $faker;

    /**
     * ServiceFixtures constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadPaymentDetails($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadPaymentDetails(ObjectManager $manager){

        for($i =0;$i<10;$i++){
            $payment  = new PaymentDetails();
            $payment
                ->setCardHolderName($this->faker->name)
                ->setCardNum($this->faker->creditCardNumber)
                ->setCardExpiry($this->faker->creditCardExpirationDate)
                ->setCardType($this->faker->creditCardType)

            ;

            $manager->persist($payment);
            $this->addReference(self::PAYMENT_REFERENCE.$i, $payment);

        }
     $manager->flush();

    }
}