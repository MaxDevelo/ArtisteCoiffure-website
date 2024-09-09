<?php

declare(strict_types= 1);

namespace App\Controller;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path:"/", name:"app_home")]
class HomeController extends AbstractController
{
    #[Route(path:"", name:"app_home_index")]
    public function index()
    {
        return $this->render("home.html.twig");
    }
}