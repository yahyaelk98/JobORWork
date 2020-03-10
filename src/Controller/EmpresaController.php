<?php

namespace App\Controller;

use App\Entity\Empresa;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/empreses", name="empreses")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $empreses = $entityManager->getRepository(Empresa::class)->findAll();

        return $this->render('empresa/index.html.twig', [
            'empreses' => $empreses
        ]);
    }

    /**
     * @Route("/detall_empresa", name="detall_empresa")
     */
    public function detallEmpresa(Request $request)
    {
        $id = $request->query->get('id');

        $entityManager = $this->getDoctrine()->getManager();

        $empresa = $entityManager->getRepository(Empresa::class)->find($id);

        return $this->render('empresa/detall_empresa.html.twig', [
            'empresa' => $empresa
        ]);
    }
}
