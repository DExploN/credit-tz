<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Model\Credit\UseCase\Bid\Create as CreateBid;
use App\ReadModel\Customer\Credit\UseCase\GetProgram;
use App\Service\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/api/customer/create-bid", methods={"POST"}, name="custimer_create_bid")
     */
    public function createBid(Validator $validator, CreateBid\Command $jsonCommand, CreateBid\Handler $handler)
    {
        $jsonCommand->bid = Uuid::uuid6()->toString();
        $validator->validate($jsonCommand);
        $handler($jsonCommand);
        return $this->json(['code' => 0], Response::HTTP_CREATED);
    }
}
