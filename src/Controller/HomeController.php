<?php 

namespace App\Controller ;

use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\VehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class HomeController extends AbstractController {

   # READ 
    #[Route('/', name: 'home')]
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        $vehicules= $vehiculeRepository->findAll();
        return $this->render('front/home.html.twig', [
            'vehicules'=> $vehicules,
        ]);
    }
    
    #[Route('/mentions_legales', name: 'mentions_legales')]
    public function mentions_legales(){
        return $this->render('front/mentions_legales.html.twig');
    }
}