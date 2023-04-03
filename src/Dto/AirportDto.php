<?php

namespace App\Dto;

use App\Entity\Airport;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AirportDto
{
    public function Airportdto(Airport $data){

        $airport = new Airport();
        $airport->setId($data->getId());
        $airport->setShortcode($data->getShortcode());
        $airport->setName($data->getName());
        $airport->setCity($data->getCity());
        $airport->setCountry($data->getCountry());
        $airport->setLocation($data->getLocation());

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $reports = $serializer->serialize($airport, 'json');
        return $reports;
    }
}
