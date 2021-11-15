<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class BlogController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/blog/', name: 'blog_index', methods: ['GET'])]
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('admin/blog/index.html.twig', [
            'blogs' => $blogRepository->findByBlog(),
        ]);
    }


    #[Route('/blog/new', name: 'blog_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $blog = new Blog();
        $blog->setType("blog");
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('admin_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_show', methods: ['GET'])]
    public function show(Blog $blog): Response
    {
        return $this->render('admin/blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route('/blog/{id}/edit', name: 'blog_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Blog $blog): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($blog);
            $this->entityManager->flush();
            return $this->redirectToRoute('admin_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_delete', methods: ['POST'])]
    public function delete(Request $request, Blog $blog): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_blog_index', [], Response::HTTP_SEE_OTHER);
    }


}
