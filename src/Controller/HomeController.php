<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }
    /**
     * @Route("/",name="home")
     * @return Response
     */

    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return new Response($this->twig->render('pages/home.html.twig', [
            'properties' => $properties,
        ]));
    }
}
