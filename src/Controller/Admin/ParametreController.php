<?php

namespace App\Controller\Admin;

use App\Entity\Parametre;
use App\Repository\ParametreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploaderHelper;

#[Route('/admin', name: 'admin_')]
class ParametreController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/parametre', name: 'parametre', methods: ['GET', 'POST'])]
    public function new(Request $request, ParametreRepository $parametreRepository): Response
    {
        $facebook = $parametreRepository->findOneBy(['nom' => 'FACEBOOK']);
        $instagram = $parametreRepository->findOneBy(['nom' => 'INSTAGRAM']);
        $youtube = $parametreRepository->findOneBy(['nom' => 'YOUTUBE']);
        $linkedin = $parametreRepository->findOneBy(['nom' => 'LINKEDIN']);
        $tel1 = $parametreRepository->findOneBy(['nom' => 'NUM1']);
        $tel2 = $parametreRepository->findOneBy(['nom' => 'NUM2']);
        $adresse = $parametreRepository->findOneBy(['nom' => 'ADRESSE']);
        $ville = $parametreRepository->findOneBy(['nom' => 'VILLE']);
        $email = $parametreRepository->findOneBy(['nom' => 'EMAIL']);
        $jourdebut = $parametreRepository->findOneBy(['nom' => 'JourDebut']);
        $jourfin = $parametreRepository->findOneBy(['nom' => 'JourFin']);
        $heuredebut = $parametreRepository->findOneBy(['nom' => 'HeureDebut']);
        $heurefin = $parametreRepository->findOneBy(['nom' => 'HeureFin']);

        if (!$instagram) {
            $instagram = new Parametre();
            $instagram->setNom('INSTAGRAM')->setValeur($request->request->get('INSTAGRAM'));
        }
        if (!$facebook) {
            $facebook = new Parametre();
            $facebook->setNom('FACEBOOK')->setValeur($request->request->get('FACEBOOK'));
        }
        if (!$youtube) {
            $youtube = new Parametre();
            $youtube->setNom('YOUTUBE')->setValeur($request->request->get('YOUTUBE'));
        }

        if (!$linkedin) {
            $linkedin = new Parametre();
            $linkedin->setNom('LINKEDIN')->setValeur($request->request->get('LINKEDIN'));
        }
        if (!$tel1) {
            $tel1 = new Parametre();
            $tel1->setNom('NUM1')->setValeur($request->request->get('NUM1'));
        }

        if (!$tel2) {
            $tel2 = new Parametre();
            $tel2->setNom('NUM2')->setValeur($request->request->get('NUM2'));
        }
        if (!$adresse) {
            $adresse = new Parametre();
            $adresse->setNom('ADRESSE')->setValeur($request->request->get('ADRESSE'));
            $adresse->setNom('ADRESSE')->setValeurEnglish($request->request->get('ADDRES'));
        }
        if (!$ville) {
            $ville = new Parametre();
            $ville->setNom('VILLE')->setValeur($request->request->get('VILLE'));
        }
        if (!$email) {
            $email = new Parametre();
            $email->setNom('EMAIL')->setValeur($request->request->get('EMAIL'));
        }
        if (!$jourdebut) {
            $jourdebut = new Parametre();
            $jourdebut->setNom('JourDebut')->setValeur($request->request->get('JourDebut'));
            $jourdebut->setNom('JourDebut')->setValeurEnglish($request->request->get('DayDebut'));
        }
        if (!$jourfin) {
            $jourfin = new Parametre();
            $jourfin->setNom('JourFin')->setValeur($request->request->get('JourFin'));
            $jourfin->setNom('JourFin')->setValeurEnglish($request->request->get('DayFin'));
        }
        if (!$heuredebut) {
            $heuredebut = new Parametre();
            $heuredebut->setNom('HeureDebut')->setValeur($request->request->get('HeureDebut'));
            $heuredebut->setNom('HeureDebut')->setValeurEnglish($request->request->get('TimeDebut'));
        }

        if (!$heurefin) {
            $heurefin = new Parametre();
            $heurefin->setNom('HeureFin')->setValeur($request->request->get('HeureFin'));
            $heurefin->setNom('HeureFin')->setValeurEnglish($request->request->get('TimeFin'));
        }


        if ($request->isMethod('POST')) {
            if ($facebook) {
                $facebook->setValeur($request->request->get('FACEBOOK'));
            }

            if ($instagram) {
                $instagram->setValeur($request->request->get('INSTAGRAM'));
            }

            if ($youtube) {
                $youtube->setValeur($request->request->get('YOUTUBE'));
            }

            if ($linkedin) {
                $linkedin->setValeur($request->request->get('LINKEDIN'));
            }
            if ($tel1) {
                $tel1->setValeur($request->request->get('NUM1'));
            }

            if ($tel2) {
                $tel2->setValeur($request->request->get('NUM2'));
            }
            if ($adresse) {
                $adresse->setValeur($request->request->get('ADRESSE'));
                $adresse->setValeurEnglish($request->request->get('ADDRES'));
            }
            if ($ville) {
                $ville->setValeur($request->request->get('VILLE'));
            }
            if ($email) {
                $email->setValeur($request->request->get('EMAIL'));
            }
            if ($jourdebut) {
                $jourdebut->setValeurEnglish($request->request->get('DayDebut'));
                $jourdebut->setValeur($request->request->get('JourDebut'));
            }
            if ($jourfin) {
                $jourfin->setValeurEnglish($request->request->get('DayFin'));
                $jourfin->setValeur($request->request->get('JourFin'));
            }
            if ($heuredebut) {
                $heuredebut->setValeurEnglish($request->request->get('TimeDebut'));
                $heuredebut->setValeur($request->request->get('HeureDebut'));
            }

            if ($heurefin) {
                $heurefin->setValeurEnglish($request->request->get('HeureFin'));
                $heurefin->setValeur($request->request->get('TimeFin'));
            }
        }

        $this->entityManager->persist($facebook);
        $this->entityManager->persist($instagram);
        $this->entityManager->persist($youtube);
        $this->entityManager->persist($linkedin);
        $this->entityManager->persist($tel1);
        $this->entityManager->persist($tel2);
        $this->entityManager->persist($adresse);
        $this->entityManager->persist($ville);
        $this->entityManager->persist($email);
        $this->entityManager->persist($jourdebut);
        $this->entityManager->persist($jourfin);
        $this->entityManager->persist($heuredebut);
        $this->entityManager->persist($heurefin);


        $this->entityManager->flush();
        return $this->render('admin/parametre/new.html.twig', [
            'facebook' => $facebook->getValeur(),
            'instagram' => $instagram->getValeur(),
            'youtube' => $youtube->getValeur(),
            'linkedin' => $linkedin->getValeur(),
            'tel1' => $tel1->getValeur(),
            'tel2' => $tel2->getValeur(),
            'adresse' => $adresse->getValeur(),
            'addres' => $adresse->getValeurEnglish(),
            'ville' => $ville->getValeur(),
            'email' => $email->getValeur(),
            'jourdebut' => $jourdebut->getValeur(),
            'jourfin' => $jourfin->getValeur(),
            'heuredebut' => $heuredebut->getValeur(),
            'heurefin' => $heurefin->getValeur(),
            'daydebut' => $jourdebut->getValeurEnglish(),
            'dayfin' => $jourfin->getValeurEnglish(),
            'timedebut' => $heuredebut->getValeurEnglish(),
            'timefin' => $heurefin->getValeurEnglish(),
        ]);
    }

    #[Route('/parametre/home', name: 'parametre_accueil', methods: ['GET', 'POST'])]
    public function newAccueil(UploaderHelper $uploadhelper, Request $request, ParametreRepository $parametreRepository): Response
    {
        $baniere1 = $parametreRepository->findOneBy(['nom' => 'BANIERE1']);
        $baniere2 = $parametreRepository->findOneBy(['nom' => 'BANIERE2']);
        $baniere3 = $parametreRepository->findOneBy(['nom' => 'BANIERE3']);

        if (!$baniere1) {
            $baniere1 = new Parametre();
            $baniere1->setNom('BANIERE1')->setValeur("");
        }

        if (!$baniere2) {
            $baniere2 = new Parametre();
            $baniere2->setNom('BANIERE2')->setValeur("");
        }

        if (!$baniere3) {
            $baniere3 = new Parametre();
            $baniere3->setNom('BANIERE3')->setValeur("");
        }


        if ($request->isMethod('POST')) {

            $imageuplbaniere1 = $request->files->get('BANIERE1');
            $imageNamebaniere1 = $uploadhelper->uploadImage($imageuplbaniere1, 'parametres/homeBanieres', 500);
            if ($imageuplbaniere1) {
                $baniere1->setValeur($imageNamebaniere1);

            }

            $imageuplbaniere2 = $request->files->get('BANIERE2');
            $imageNamebaniere2 = $uploadhelper->uploadImage($imageuplbaniere2, 'parametres/homeBanieres', 500);
            if ($imageuplbaniere2) {
                $baniere2->setValeur($imageNamebaniere2);

            }

            $imageuplbaniere3 = $request->files->get('BANIERE3');
            $imageNamebaniere3 = $uploadhelper->uploadImage($imageuplbaniere3, 'parametres/homeBanieres', 500);
            if ($imageuplbaniere3) {
                $baniere3->setValeur($imageNamebaniere3);
            }

        }

        $this->entityManager->persist($baniere1);
        $this->entityManager->persist($baniere2);
        $this->entityManager->persist($baniere3);


        $this->entityManager->flush();
        return $this->render('admin/parametre/edit.html.twig', [
            'BANIERE1' => $baniere1->getValeur(),
            'BANIERE2' => $baniere2->getValeur(),
            'BANIERE3' => $baniere3->getValeur(),
        ]);
    }

    #[Route('/parametre/a_propos', name: 'parametre_a_propos', methods: ['GET', 'POST'])]
    public function newAPropos(UploaderHelper $uploadhelper, Request $request, ParametreRepository $parametreRepository): Response
    {
        $bienvenue = $parametreRepository->findOneBy(['nom' => 'BIENVENUE']);
        $mission = $parametreRepository->findOneBy(['nom' => 'MISSION']);
        $image = $parametreRepository->findOneBy(['nom' => 'image1']);
        $image2 = $parametreRepository->findOneBy(['nom' => 'image2']);

        if (!$bienvenue) {
            $bienvenue = new Parametre();
            $bienvenue->setNom('BIENVENUE')->setValeur($request->request->get('BIENVENUE'));
            $bienvenue->setNom('BIENVENUE')->setValeurEnglish($request->request->get('WELCOME'));
        }

        if (!$mission) {
            $mission = new Parametre();
            $mission->setNom('MISSION')->setValeur($request->request->get('MISSION'));
            $mission->setNom('MISSION')->setValeur($request->request->get('MISSIONEN'));
        }

        if (!$image) {
            $image = new Parametre();
            $image->setNom('image1')->setValeur("");
        }

        if (!$image2) {
            $image2 = new Parametre();
            $image2->setNom('image2')->setValeur("");
        }


        if ($request->isMethod('POST')) {
            if ($bienvenue) {
                $bienvenue->setValeur($request->request->get('BIENVENUE'));
                $bienvenue->setValeurEnglish($request->request->get('WELCOME'));
            }

            if ($mission) {
                $mission->setValeur($request->request->get('MISSION'));
                $mission->setValeurEnglish($request->request->get('MISSIONEN'));
            }

            $imageupl = $request->files->get('image1');
            $imageName = $uploadhelper->uploadImage($imageupl, 'parametres/apropos', 500);
            if ($imageupl) {
                $image->setValeur($imageName);

            }

            $imageupl2 = $request->files->get('image2');
            $imageName2 = $uploadhelper->uploadImage($imageupl2, 'parametres/apropos', 500);
            if ($imageupl2) {
                $image2->setValeur($imageName2);

            }

        }
        $this->entityManager->persist($image);
        $this->entityManager->persist($image2);

        $this->entityManager->persist($bienvenue);
        $this->entityManager->persist($mission);


        $this->entityManager->flush();
        return $this->render('admin/parametre/a_propos_paramtetre.html.twig', [
            'bienvenue' => $bienvenue->getValeur(),
            'welcome' => $bienvenue->getValeurEnglish(),
            'mission' => $mission->getValeur(),
            'missionen' => $mission->getValeurEnglish(),
            'image1' => $image->getValeur(),
            'image2' => $image2->getValeur(),
        ]);
    }

    #[Route('/parametre/newCatalogue', name: 'parametre_new_catalogue', methods: ['GET', 'POST'])]
    public function newCatalogue(UploaderHelper $uploadhelper, Request $request, ParametreRepository $parametreRepository): Response
    {
        $catalogue = $parametreRepository->findOneBy(['nom' => 'catalogue']);

        if (!$catalogue) {
            $catalogue = new Parametre();
            $catalogue->setNom('catalogue')->setValeur("");
        }


        if ($request->isMethod('POST')) {
            $catalogueupload = $request->files->get('catalogue');
            $catalogueName = $uploadhelper->uploadImage($catalogueupload, 'parametres/catalogue', 500);
            if ($catalogueupload) {
                $catalogue->setValeur($catalogueName);

            }

        }
        $this->entityManager->persist($catalogue);


        $this->entityManager->flush();
        return $this->render('admin/parametre/index_catalogue.html.twig', [
            'catalogue' => $catalogue->getValeur(),
        ]);
    }

}
