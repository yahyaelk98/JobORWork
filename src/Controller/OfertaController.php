<?php

namespace App\Controller;

use App\Entity\Oferta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OfertaController extends AbstractController
{
    /**
     * @Route("/", name="ofertes")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ofertes = $entityManager->getRepository(Oferta::class)->findAll();

        return $this->render('oferta/index.html.twig', [
            'ofertes' => $ofertes
        ]);
    }

    /**
     * @Route("/detall_oferta", name="detall_oferta")
     */
    public function detallOferta(Request $request)
    {
        $id = $request->query->get('id');

        $entityManager = $this->getDoctrine()->getManager();

        $oferta = $entityManager->getRepository(Oferta::class)->find($id);

        return $this->render('oferta/detall_oferta.html.twig', [
            'oferta' => $oferta
        ]);
    }
}
