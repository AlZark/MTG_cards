<?php

namespace App\Controller;

use App\Service\SetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SetController extends AbstractController
{
    #[Route('sets/', name: 'sets')]
    public function getSets(Request $request, SetService $service): Response
    {
        $q = $request->query->get('q');
        $sets = $this->json($service->getAllSets($q)->toArray())->getContent();

        $data = json_decode($sets, true);

        return $this->render('set/list.html.twig', [
            'title' => 'MTG sets',
            'sets' => $data['sets'],
        ]);
    }
}