<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Choice;

class AirportValidator
{
    public function getAirportInfoByFieldValid(Request $request){

        $request = $request->toArray();
        $validator = Validation::createValidator();
        $allowedValues = ['id', 'name', 'country','shortcode','city'];
        $violationsType = $validator->validate($request['type'], [
            new Length(['max' => 255]),
            new NotBlank(),
            new NotNull(),
            new Choice([
                'choices' => $allowedValues,
                'message' => sprintf('The value(type) must be one of "%s".', implode('", "', $allowedValues)),
            ]),
        ]);



        if (count($violationsType) > 0) {

            foreach ($violationsType as $violation) {
                echo json_encode(array(
                    "success" => 'FALSE',
                    "Message" => $violation->getMessage() . "\n"
                ));
                exit();
            }

        }

        $violationssearchString = $validator->validate($request['searchString'], [
            new Length(['max' => 255]),
            new NotBlank(),
            new NotNull()
        ]);

        if (count($violationssearchString) > 0) {
            foreach ($violationssearchString as $violation) {
                echo json_encode(array(
                    "success" => 'FALSE',
                    "Message" => $violation->getMessage() . "\n"
                ));
                exit();
            }
        }


    }

}
