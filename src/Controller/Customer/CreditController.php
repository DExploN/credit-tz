<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\ReadModel\Customer\Credit\UseCase\GetProgram;
use App\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreditController extends AbstractController
{
    /**
     * @Route("/api/customer/find-program", methods={"GET"}, name="custimer_find_program")
     */
    public function findProgram(Validator $validator, GetProgram\Query $jsonQuery, GetProgram\Handler $handler)
    {
        $validator->validate($jsonQuery);
        return $this->json($handler($jsonQuery));
    }
}
