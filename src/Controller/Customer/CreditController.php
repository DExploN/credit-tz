<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Messenger\IMessenger;
use App\Messenger\QueryBus;
use App\Model\Credit\UseCase\Bid\Create as CreateBid;
use App\Model\Credit\UseCase\Bid\Validate as ValidateBid;
use App\ReadModel\Customer\Credit\UseCase\GetProgram;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditController extends AbstractController
{
    /**
     * @Route("/api/customer/find-program", methods={"GET"}, name="custimer_find_program")
     */
    public function findProgram(GetProgram\Query $jsonQuery, QueryBus $bus)
    {
        return $this->json($bus->query($jsonQuery));
    }

    /**
     * @Route("/api/customer/create-bid", methods={"POST"}, name="custimer_create_bid")
     */
    public function createBid(
        CreateBid\Command $jsonCreateCommand,
        ValidateBid\Command $jsonValidateCommand,
        IMessenger $IMessenger
    ) {
        $jsonCreateCommand->bid = Uuid::uuid6()->toString();
        $IMessenger->dispatch([$jsonValidateCommand, $jsonCreateCommand]);
        return $this->json(['code' => 0], Response::HTTP_CREATED);
    }
}
