<?php

namespace App\Controller\Front;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use App\Repository\CategorieRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale<en|fr>}', name: 'front_')]
class BlogController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/blog', name: 'blog_index', methods: ['GET'])]
    public function index(Request $request,PaginatorInterface $paginator,BlogRepository $blogRepository,VideoRepository $videoRepository,CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $blog = $blogRepository->findByCreationDate();

        $pagination = $paginator->paginate(
            $blog, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('front/blog/index.html.twig', [
            'categories' => $categories,
            'blogs' => $pagination,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_show', methods: ['GET'])]
    public function show(Blog $blog,CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->render('front/blog/show.html.twig', [
            'categories' => $categories,
            'blog' => $blog,
        ]);
    }

}
