<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 *
 * @Route("/api", name="api_")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("", name="main")
     */
    public function index()
    {
        return $this->json(['ok']);
    }
}
