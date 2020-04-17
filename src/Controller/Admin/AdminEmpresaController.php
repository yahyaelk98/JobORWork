<?php

namespace App\Controller\Admin;

use App\Entity\Empresa;
use App\Form\EmpresaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminEmpresaController extends AbstractController
{
    /**
     * @Route("/adminEmpresa", name="adminEmpresa")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $empreses = $entityManager->getRepository(Empresa::class)->findAll();

        return $this->render('admin/admin_empresa/index.html.twig', [
            'empreses' => $empreses,
        ]);
    }

    /**
     * @Route("/admin/empresa/modificar/{id}", name="admin_empresa_modif")
     */
    public function modifEmpresa(Empresa $empresa, Request $request){
        $form = $this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($empresa);
            $manager->flush();
            return $this->redirectToRoute('adminEmpresa');
        }

        return $this->render('admin/admin_empresa/modif_empresa.html.twig', [
            'empresa' => $empresa,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/empresa/eliminar/{id}", name="admin_empresa_elim")
     */
    public function elimEmpresa(Empresa $empresa)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($empresa);
        $manager->flush();
        return $this->redirectToRoute('adminEmpresa');
    }

    /**
     * @Route("/admin/empresa/afegir", name="admin_empresa_afeg")
     */
    public function afegEmpresa(Request $request)
    {
        $form = $this->createForm(EmpresaType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $empresa = new Empresa();
            $empresa->setNom($form->get('nom')->getData());
            $empresa->setTipus($form->get('tipus')->getData());
            $empresa->setCorreu($form->get('correu')->getData());
            $empresa->setLogo($form->get('logo')->getData());

            $manager->persist($empresa);
            $manager->flush();
            return $this->redirectToRoute('adminEmpresa');
        }

        return $this->render('admin/admin_empresa/afegir_empresa.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
