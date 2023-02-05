<?php

namespace App\Controller;

use App\Entity\Decks;
use App\Service\DeckService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeckCardsController extends AbstractController
{
    #[Route('decks/', name: 'decks')]
    public function getDecks(EntityManagerInterface $entityManager, DeckService $deckService)
    {

        $deckService = $entityManager->getRepository(Decks::class);
        $decks = $deckService->findAll();



        dd($decks);

        return 'TODO DECK LIST';
    }
}