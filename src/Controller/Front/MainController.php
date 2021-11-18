<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/change-locale/{locale}', name: 'change_locale')]
    public function changeLocale($locale, Request $request)
    {
        $referer=$request->headers->get('referer');
        $currentLocal=$request->getSession()->get('_locale');
        $referer=str_replace($currentLocal,$locale,$referer);
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);
         return $this->redirect($referer,301);
    }
}
