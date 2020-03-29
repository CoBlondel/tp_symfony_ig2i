<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/home", name="home")
     */
    public function showAll()
    {
        return $this->render('home/index.html.twig', [
            'articles' => $this->articleRepository->findAll()
        ]);
    }

    /**
     * @Route("/last", name="last")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'articles' => $this->articleRepository->findLast(4)
        ]);
    }
}
