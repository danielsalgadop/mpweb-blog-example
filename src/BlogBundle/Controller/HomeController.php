<?php

namespace BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    public function homeAction():JsonResponse
    {
        return new JsonResponse(['msg' => 'Welcome to our Blog!'], 200);
    }
}

