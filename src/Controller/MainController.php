<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $repository = $this->getDoctrine()->getRepository(News::class);

        $news = $repository->findAll();
        return $this->render('main/index.html.twig', [
            'news' => $news,
        ]);
    }
}
