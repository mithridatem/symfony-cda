<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{

    public function __construct(
        private readonly GameRepository $gameRepo
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/home', name: 'app_home_connected')]
    #[IsGranted('ROLE_USER')]
    public function homeConnected()
    {
        return $this->render('home/index_connected.html.twig', []);
    }
    #[Route('/home/dto', name: 'app_home_dto')]
    public function showAllGameDTO(): Response
    {
        return $this->render('home/show_all_game_dto.html.twig', [
            'game_dto' => $this->gameRepo->findGameDTO()
        ]);
    }
}
