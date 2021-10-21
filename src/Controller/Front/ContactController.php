<?php

namespace App\Controller\Front;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'front_')]
class ContactController extends AbstractController
{

    #[Route('/contact/new', name: 'contact_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('front_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

}
