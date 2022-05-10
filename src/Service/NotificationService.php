<?php

namespace App\Service;


use App\Repository\NotificationRepository;
use App\Entity\Notification;

class NotificationService
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getNbrNotification($user)
    {
        $count= $this->notificationRepository->nbrNotif($user);
        return $count;
    }

    public function getNotifAdmin($user)
    {
        $msg=[];
        $notifications = $this->notificationRepository->notifLimit8admin($user);
        foreach($notifications as $notification)
        {
            $msg[] = $notification;
        }
        return $msg;
    }


}