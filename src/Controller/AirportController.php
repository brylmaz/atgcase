<?php

namespace App\Controller;

use App\Dto\AirportDto;
use App\Entity\Airport;
use App\Exception\AirportOrmFailException;
use App\Repository\AirportRepository;
use App\Validator\AirportValidator;
use Doctrine\DBAL\Exception\ServerException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AirportController extends AbstractController
{
    private AirportRepository $airportRepository;
    private AirportValidator $airportValidator;
    private AirportDto $airportDto;
    private AirportOrmFailException $airportOrmFailException;

    public function __construct(AirportRepository $airportRepository,AirportValidator $airportValidator,AirportDto $airportDto,AirportOrmFailException $airportOrmFailException)
    {
        $this->airportRepository = $airportRepository;
        $this->airportValidator = $airportValidator;
        $this->airportDto = $airportDto;
        $this->airportOrmFailException=$airportOrmFailException;

    }

    #[Route('/api/v1/search', name: 'airport_search',methods: ['POST'])]
//    #[QueryParam(name:"type", requirements:"[A-Z]+", nullable:false)]
//    #[QueryParam(name:"searchString", requirements:"[A-Z]+", nullable:false)]
    public function getAirportInfoByField(Request $request)
    {
        $this->airportValidator->getAirportInfoByFieldValid($request);



        try {
            $request = $request->toArray();
            $airport = $this->airportRepository->findOneBy(
                [$request['type'] => $request['searchString']]
            );
        }
        catch (Doctrine_Connection_Exception $e){
            throw new AirportOrmFailException("Bir Hata Oluştu");
        }


        if ($airport==null){
            throw new AirportOrmFailException("Girilen değerler ile ilgili bir kayıt bulunamadı.");
        }
        $reports = $this->airportDto->Airportdto($airport);

        return new Response($reports);
    }


}
