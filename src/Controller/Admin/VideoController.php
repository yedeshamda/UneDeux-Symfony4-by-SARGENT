<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/admin', name: 'admin_')]
class VideoController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/video', name: 'video_index', methods: ['GET'])]
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('admin/video/index.html.twig', [
            'blogs' => $blogRepository->findByVideo(),
        ]);
    }

    #[Route('/video/new', name: 'video_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $blog = new Blog();
        $blog->setType("video");
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uuid = Uuid::v1();
            $imagename=$uuid->toBase58();
            $video=$form->get('imageFile')->getData();
            $ffmpeg = FFMpeg::create();
            $video = $ffmpeg->open($video);
            $video->frame(TimeCode::fromSeconds(5))->save('./images/blogs/'.$imagename.'.jpg');
            $blog->setImageVideo($imagename.'.jpg');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/video/new.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/video/{id}', name: 'video_show', methods: ['GET'])]
    public function show(Blog $blog): Response
    {
        return $this->render('admin/video/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route('/video/{id}/edit', name: 'video_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Blog $blog): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($blog);
            $this->entityManager->flush();
            return $this->redirectToRoute('admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/video/edit.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    #[Route('/video/{id}', name: 'video_delete', methods: ['POST'])]
    public function delete(Request $request, Blog $blog): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_video_index', [], Response::HTTP_SEE_OTHER);
    }
}
