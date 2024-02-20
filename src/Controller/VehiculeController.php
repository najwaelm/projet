<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;



#[Route('/vehicule')]
#[IsGranted('ROLE_USER')]
class VehiculeController extends AbstractController
{
  
    #[Route('/', name: 'index_vehicule')]
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        $vehicules= $vehiculeRepository->findAll();
        return $this->render('vehicule/index.html.twig', [
            'vehicules'=> $vehicules,
        ]);
    }

    # AJOUTER UN VEHICULE
    #[Route("/new", name: "new_vehicule")]
    public function new_vehicule( Request $request, EntityManagerInterface $em){

        

        $data=[];
        $categorie = new Vehicule();
        $form= $this->createForm(VehiculeType::class, $categorie); 

        $data["form"]= $form;

        $form->handleRequest(($request));

        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($categorie); 
            $em->flush(); 
            return $this->redirectToRoute("index_vehicule"); 
        }; 

        return $this->render("vehicule/new_vehicule.html.twig",$data);
    }

    # MODIFIER UN VEHICULE

     #[Route("/update/{id}", name: "update_vehicule")]
     public function update(int $id,
      VehiculeRepository $vehiculeRepository,
       Request $request,  
        EntityManagerInterface $em){ 
         	$vehicule = $vehiculeRepository->findOneBy(["id"=>$id]);
             $form=$this->createForm(VehiculeType::class, $vehicule,["label"=>"modifier"]);

             $form->handleRequest($request);
             if($form->isSubmitted()&&$form->isValid()){
                 $em->persist($vehicule); 
                 $em->flush(); 
                 return $this->redirectToRoute("index_vehicule");
             }

             return $this->render("vehicule/update.html.twig",["form"=> $form]);
    }
    # SUPPRIMER UN VEHICULE

    #[Route("/delete/{id}", name: "delete_vehicule")]
    public function delete(
            EntityManagerInterface $em,
            VehiculeRepository $vehiculeRepository,
            int $id,
        ){
        $vehicule = $vehiculeRepository->FindOneBy(["id"=>$id]);
        $em->remove($vehicule);
        $em->flush();
        return $this->redirectToRoute("index_vehicule");
     }
}
