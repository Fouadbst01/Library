<?php
namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageContoller extends AbstractController{
  #[Route('/', name: 'landingpage_index', methods: ['GET'])]
    public function index(LivreRepository $LivreRepository): Response
    {
        return $this->render('LandingPage.html.twig',[
          'livres' => $LivreRepository->findAll()
        ]);
    }
}