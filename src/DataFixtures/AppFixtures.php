<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $path = '/srv/app/src/Storage/csv/airports.csv';
        $handle = fopen($path, "r"); // open in readonly mode
        while (($row = fgetcsv($handle)) !== false) {
            $airport = new Airport();
            $airport->setShortcode($row[1]);
            $airport->setName($row[2]);
            $airport->setCity($row[3]);
            $airport->setCountry($row[4]);
            $airport->setLocation($row[5]);
            $manager->persist($airport);
        }
        fclose($handle);



        $manager->flush();
    }
}
