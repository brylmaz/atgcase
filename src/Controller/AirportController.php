<?php

namespace App\Controller;

use App\Dto\AirportDto;
use App\Exception\AirportOrmFailException;
use App\Repository\AirportRepository;
use App\Validator\AirportValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function getAirportInfoByField(Request $request)
    {
        $this->airportValidator->getAirportInfoByFieldValid($request);

        try {
            $request = $request->toArray();
            $airport = $this->airportRepository->findBy([$request['type'] => $request['searchString']]);
        }
        catch (Doctrine_Connection_Exception $e){
            throw new AirportOrmFailException("Bir Hata Oluştu");
        }

        if (empty($airport)){
            throw new AirportOrmFailException("Girilen değerler ile ilgili bir kayıt bulunamadı.");
        }

        $reports = $this->airportDto->Airportdto($airport);

        return new Response($reports);
    }


}
