<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\GameRepository;
use ApiPlatform\Validator\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class GameExistProcessor implements ProcessorInterface
{
    public function __construct(
        private ProcessorInterface $processor,
        private readonly GameRepository $gameRepository,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {

        //si l'objet existe 
        if ($this->gameRepository->findOneBy(["title" => $data->getTitle(), "type" => $data->getType()])) {

            $violations = new ConstraintViolationList([
                new ConstraintViolation(
                    'Ce jeu existe déjà',
                    null,
                    [],
                    $data,
                    'title',
                    $data->getTitle(),
                    null,
                    422
                )
            ]);
            //Lever une exception le jeu existe déja
            throw new ValidationException($violations, 422);
        }

        //je retourne le process
        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}
