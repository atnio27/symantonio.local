<?php

namespace App\Controller;

use App\Entity\Asociado;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AsociadoController extends AbstractController
{
    #[Route('/asociado', name: 'app_asociado')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $asociados = $doctrine->getRepository(Asociado::class)->findAll();

        return $this->render('asociado/index.html.twig', [
            'asociados' => $asociados
        ]);
    }
}
