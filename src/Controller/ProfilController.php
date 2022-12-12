<?php

namespace App\Controller;

use App\Entity\AnnonceListByUser;
use App\Repository\AnnonceListByUserRepository;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository, AnnonceListByUserRepository $annonceListByUserRepository): Response
    {
        $author = $this->getUser();
        return $this->render('profil/index.html.twig', [
            'annonces' => $annonceRepository->findBy([
                'author' => $author
            ]),
            'annoncesFav' => $annonceListByUserRepository->findBy([
                'users' => $author
            ])
        ]);
    }
}
