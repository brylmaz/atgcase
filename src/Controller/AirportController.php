<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AirportController extends AbstractController
{
    #[Route('/api/v1/search', name: 'airport_search',methods: ['POST'])]
    public function getAirportInfoByField()
    {




    }
}
