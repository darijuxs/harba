<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController.
 *
 * @Route("/", name="main_", methods={"GET"})
 */
class MainController extends ApiAbstractController
{
    /**
     * @Route("/", name="main")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('base.html.twig');
    }
}
