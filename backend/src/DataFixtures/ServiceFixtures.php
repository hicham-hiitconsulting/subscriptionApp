<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class ServiceFixtures.
 */
class ServiceFixtures extends Fixture
{
    public const SERVICE_REFERENCE = 'service-fix';

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
        $this->loadService($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadService(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $service = new Service();
            $service->setName("Passerelle N° $i");
            $service->setUrl($this->faker->url);
            $service->setPrice($this->faker->numberBetween(10, 2000));
            $manager->persist($service);
            $this->addReference(self::SERVICE_REFERENCE.$i, $service);
        }
        $manager->flush();
    }
}
