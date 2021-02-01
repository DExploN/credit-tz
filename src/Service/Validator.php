<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\ValidateException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($object): void
    {
        $errors = $this->validator->validate($object);
        if (count($errors) > 0) {
            $errorList = [];
            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                $errorList[] = ['message' => $error->getMessage(), 'property' => $error->getPropertyPath()];
            }
            throw new ValidateException($errorList);
        }
    }
}
