<?php

namespace App\Controller\Front;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'front_')]
class BlogController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/blog/', name: 'blog_index', methods: ['GET'])]
    public function index(Request $request,PaginatorInterface $paginator,BlogRepository $blogRepository,VideoRepository $videoRepository): Response
    {
        $blog = $blogRepository->findByCreationDate();

        $pagination = $paginator->paginate(
            $blog, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('front/blog/index.html.twig', [
            'blogs' => $pagination,
        ]);
    }

}
