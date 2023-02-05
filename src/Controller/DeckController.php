<?php

namespace App\Controller;

use App\Entity\DeckCards;
use App\Entity\Decks;
use App\Repository\DeckCardsRepository;
use App\Repository\DecksRepository;
use App\Service\DeckService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeckController extends AbstractController
{

    #[Route('decks/', name: 'decks')]
    public function getDecks(EntityManagerInterface $entityManager)
    {

        $deckService = $entityManager->getRepository(Decks::class);
        $decks = $deckService->findAll();

        dd($decks);

        return 'TODO DECK LIST';
    }

    #[Route('decks/new')]
    public function newDeck()
    {
        return $this->render('deck/new.html.twig', [
            'title' => 'Your new MTG Deck',
        ]);
    }

    #[Route('decks/create', name: 'create_deck', methods: 'post')]
    public function createDeck(EntityManagerInterface $entityManager, Request $request): Response
    {
        $deck = new Decks();
        $deck->setName($request->request->get('name'));

        $entityManager->persist($deck);
        $entityManager->flush();

        return $this->redirectToRoute('add_cards', ['id' => $deck->getId()]);
    }

    #[Route('decks/{id}/cards', name: 'add_cards')]
    public function editDeckCards(int $id, DecksRepository $decksRepository, DeckCardsRepository $deckCardsRepository)
    {
        return $this->render('deck/add_cards.html.twig', [
            'title' => 'Your new MTG Deck',
            'deck' => $decksRepository->find($id)->getName(),
            'deckCards' => $deckCardsRepository->findBy(['deckId' => $id])
        ]);
    }

    #[Route('decks/add/card', name: 'add_to_deck', methods: ['post'])]
    public function addDeckCard(EntityManagerInterface $entityManager, Request $request)
    {
        $deckCard = new DeckCards();

        //dd($request);
        $deckCard->setCardId($request->request->get('card'));
        $deckCard->setDeckId($request->request->get('deck'));

        $entityManager->persist($deckCard);
        $entityManager->flush();

        return $this->redirectToRoute('cards');
    }

    #[Route('deck/{id}', name: 'deck', methods: ['get'])]
    public function deck(int $id, DeckCardsRepository $deckCardsRepository)
    {

        $deckCards = $deckCardsRepository->findBy(['deckId' => $id]);

        //TODO put every card id into an array. And pull all the information from API

        return $this->render('deck/view.html.twig', [
            'title' => 'Your Deck',
            'deckCards' => $deckCardsRepository->findBy(['deckId' => $id])
        ]);
    }
}