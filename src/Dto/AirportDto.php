<?php

namespace App\Dto;

use App\Entity\Airport;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AirportDto
{
    public function Airportdto(array $data)
    {
        $responseArray = array();

        foreach ($data as $airport) {
            $airportEntity = new Airport();
            $airportEntity->setId($airport->getId());
            $airportEntity->setShortcode($airport->getShortcode());
            $airportEntity->setName($airport->getName());
            $airportEntity->setCity($airport->getCity());
            $airportEntity->setCountry($airport->getCountry());
            $airportEntity->setLocation($airport->getLocation());

            $responseArray[] = $airportEntity;
        }

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $reports = $serializer->serialize($responseArray, 'json');

        return $reports;
    }
}
