<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{

    /**
     * Matches /news/*
     *
     * @Route("/news/{slug}", name="news_show")
     */
    public function show($slug)
    {
        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->findOneBySlug($slug);

        if (!$news) {
            throw $this->createNotFoundException(
                'No product found for id '.$slug
            );
        }
        return $this->render('news/show.html.twig', [
            'news' => $news,
        ]);
    }
}
