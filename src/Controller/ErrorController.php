<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    public function show404(): Response
    {
        return $this->render('error/error_404.html.twig', [], new Response('', 404));
    }
}