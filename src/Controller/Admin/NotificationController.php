<?php

namespace App\Controller\Admin;

use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class NotificationController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/notification/', name: 'notification_index', methods: ['GET'])]
    public function index(NotificationRepository $notificationRepository): Response
    {
        return $this->render('admin/notification/index.html.twig', [
            'notifications' => $notificationRepository->notifAdmin($this->getUser()),
        ]);
    }

    #[Route('notification/json', name: 'notification_json', methods: ['POST'])]
    public function abonnementList(Request $request,NotificationRepository $notificationRepository): Response
    {
        $notifications = $notificationRepository->findBy(['lecture' => false,'user'=>$this->getUser()]);

        foreach($notifications as $notification){
            $notification->setLecture(true);
            $this->entityManager->persist($notification);
        }

        $this->entityManager->flush();

        return $this->json($notifications,200,[],["groups" => "notification"]);
    }
}
