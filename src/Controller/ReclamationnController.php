<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Rate;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reclamationn")
 */
class ReclamationnController extends AbstractController
{
    /**
     * @Route("/", name="app_reclamation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("/new", name="app_reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $reclamation->setDaterec(new \DateTime('now'));

        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $reclamation->getImgrec();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e){

                // ... handle exception if something happ

            }


            $reclamation->setDescriptionrec($this->filterwords($reclamation->getDescriptionrec()));
            $reclamation->setSujetrec($this->filterwords($reclamation->getSujetrec()));
            $reclamation->setStatusrec("non traite");

            $reclamation->setImgrec( 'uploads/images/'.$fileName);
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }



    /**
     * @Route("/listrec", name="list_rec", methods={"GET", "POST"})
     */
    public function list_rec(ReclamationRepository $reclamationrepository): Response
    {
        $categories = $reclamationrepository->findAll();

        return $this->render('reclamation/dashboard.html.twig', [
            'reclamation' => $categories,
        ]);
    }

    /**
     * @Route("/traiter/{id_rec}", name="traiter", methods={"GET", "POST"})
     */
    public function traiter(ReclamationRepository $reclamationrepository,$id_rec,EntityManagerInterface $entityManager): Response
    {
        $categories = $reclamationrepository->findAll();

        $rec = $reclamationrepository->find($id_rec);

        $rec->setStatusrec("traite");

        $entityManager->flush();

        return $this->render('reclamation/dashboard.html.twig', [
            'reclamation' => $categories,
        ]);
    }



    /**
     * @Route("/untraiter/{id_rec}", name="untraiter", methods={"GET", "POST"})
     */
    public function untraiter(ReclamationRepository $reclamationrepository,$id_rec,EntityManagerInterface $entityManager): Response
    {
        $categories = $reclamationrepository->findAll();

        $rec = $reclamationrepository->find($id_rec);

        $rec->setStatusrec("non traite");

        $entityManager->flush();

        return $this->render('reclamation/dashboard.html.twig', [
            'reclamation' => $categories,
        ]);
    }




    /**
     * @Route("/{idrec}", name="app_reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("dislike/{id_rec}", name="dislike", methods={"GET"})
     */
    public function dislike($id_rec,EntityManagerInterface $entityManager,RateRepository $rate_repository,ReclamationRepository $reclamationRepository): Response
    {


        $rate_id = $rate_repository->findOneBy(['idrec' => $id_rec]);
        if($rate_id == null)
            $rate_id = new Rate();


        $rec = $reclamationRepository->find($id_rec);


        $rate_id->setRate(0);
        $rate_id->setIdrec($rec->getIdrec());
        $rate_id->setIduser($rec->getIduser());
        $rate_id->setDaterate(new \DateTime('now'));

        $rec->setLikee(0);

        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        $entityManager->persist($rate_id);
        $entityManager->flush();

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("like/{id_rec}", name="like", methods={"GET"})
     */
    public function like($id_rec,RateRepository $rate_repository,EntityManagerInterface $entityManager,ReclamationRepository $reclamationRepository): Response
    {

        $rate_id = $rate_repository->findOneBy(['idrec' => $id_rec]);
        if($rate_id == null)
            $rate_id = new Rate();




        $rec = $reclamationRepository->find($id_rec);


        $rate_id->setRate(1);
        $rate_id->setIdrec($rec->getIdrec());
        $rate_id->setIduser($rec->getIduser());
        $rate_id->setDaterate(new \DateTime('now'));

        $rec->setLikee(1);

        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        $entityManager->persist($rate_id);
        $entityManager->flush();

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("/{idrec}/edit", name="app_reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idrec}", name="app_reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdrec(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
    function filterwords($text){
        $filterWords = array('fu','pu','bi','a');
        $filterCount = sizeof($filterWords);
        for ($i = 0; $i < $filterCount; $i++) {
            $text = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $text);
        }
        return $text;
    }


    /**
     *
     * @Route("pdf/{id}", name="pdf")
     */
    public function page_pdf(ReclamationRepository $repository_rec,$id,Request $request): Response
    {

        $rec_selected = $repository_rec->find($id);

        return $this->render('reclamation\pdf.html.twig', [
            'reclamation'=> $rec_selected,
        ]);
    }


    /////////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////









////////////////////////////////////////////////////////////////////
///////////////////  list pdf  /////////////////////////////////////
////////////////////////////////////////////////////////////////////





    /**
     * @param QuestionRepository $repository
     * @param BibliothequeRepository $repository
     * @param TestRepository $repository
     * @Route("rec/pdf/{id}", name="listpdf")
     */
    public function list_pdf(ReclamationRepository $repository_rec,$id,Request $request)
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $rec_selected = $repository_rec->find($id);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reclamation/pdf.html.twig', [

            'reclamation'=> $rec_selected
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("rec.pdf", [
            "Attachment" => true
        ]);



    }



    /* /**
      *@Route("/pdf",name="pdf_index", methods={"GET"})
      */
    /* public function pdf(ReclamationRepository $ReclamationRepository): Response
     {
         // Configure Dompdf according to your needs
         $pdfOptions = new Options();
         $pdfOptions->set('defaultFont', 'Arial');

         // Instantiate Dompdf with our options
         $dompdf = new Dompdf($pdfOptions);
         'reclamation' =>$ReclamationRepository->findAll();
         // Retrieve the HTML generated in our twig file
         $html = $this->renderView('reclamation/pdf.html.twig', [
         ]);

         // Load HTML to Dompdf
         $dompdf->loadHtml($html);

         // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
         $dompdf->setPaper('A2', 'portrait');

         // Render the HTML as PDF
         $dompdf->render();
         // Output the generated PDF to Browser (inline view)
         $dompdf->stream("mypdf.pdf", [
             "Attachment" => false
         ]);
     }*/

}
