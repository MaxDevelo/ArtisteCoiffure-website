<?php

declare(strict_types= 1);

namespace App\Controller\Booking;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    #[Route(path:"/reservation_en_ligne", name:"app_booking_show")]
    public function show(): Response
    {
        return $this->render("pages/booking.html.twig");
    }
}