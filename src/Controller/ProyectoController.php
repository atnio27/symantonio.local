<?php

namespace App\Controller;

use App\Entity\Asociado;
use App\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProyectoController extends AbstractController
{
	#[Route('/', name: 'sym_index')]
	public function index()
	{
		for ($i = 1; $i <= 12; $i++) {
			$imagenesHome[] = new Imagen(
				"$i.jpg",
				"descripción imagen $i",
				1,
				rand(1, 500),
				rand(1, 700),
				rand(100, 200)
			);
		}

		$asociados = [
			new Asociado("Asociado 1", "log1.jpg", "Descripción del asociado 1"),
			new Asociado("Asociado 2", "log2.jpg", "Descripción del asociado 2"),
			new Asociado("Asociado 3", "log3.jpg", "Descripción del asociado 3")
		];

		return $this->render('index.html.twig', [
			'imagenes' => $imagenesHome,
			'asociados' => $asociados
		]);
	}

	#[Route('/about', name: 'sym_about')]
	public function about()
	{
		$imagenesClientes[] = new Imagen('client1.jpg', 'MISS BELLA');
		$imagenesClientes[] = new Imagen('client2.jpg', 'DON PENO');
		$imagenesClientes[] = new Imagen('client3.jpg', 'SWEETY');
		$imagenesClientes[] = new Imagen('client4.jpg', 'LADY');

		return $this->render('about.html.twig', [
			'imagenesClientes' => $imagenesClientes
		]);
	}

	#[Route('/contact', name: 'sym_contact')]
	public function contact()
	{
		return $this->render('contact.html.twig');
	}

	#[Route('/blog', name: 'sym_blog')]
	public function blog()
	{
		return $this->render('blog.html.twig');
	}
}
