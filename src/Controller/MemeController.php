<?php

namespace App\Controller;

use App\Service\MemeApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MemeController extends AbstractController
{
    public function __construct(
        private readonly MemeApiService $memeApiService
    )  {}

    #[Route('/meme', name: 'app_meme_show')]
    public function showMeme(): Response
    {

        return $this->render('meme/show.html.twig',
        [
            'memes' => $this->memeApiService->getMemes()["data"]["memes"]
        ]);
    }
}
