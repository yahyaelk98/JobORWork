<?php

namespace App\Controller\Admin;

use App\Entity\Empresa;
use App\Entity\Oferta;
use App\Form\OfertaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class AdminOfertaController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ofertes = $entityManager->getRepository(Oferta::class)->findAll();

        return $this->render('admin/admin_oferta/index.html.twig', [
            'ofertes' => $ofertes
        ]);
    }

    /**
     * @Route("/admin/oferta/modificar/{id}", name="admin_oferta_modif")
     */
    public function modifOferta(Oferta $oferta, Request $request)
    {
        $form = $this->createForm(OfertaType::class, $oferta);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($oferta);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/admin_oferta/modif_oferta.html.twig', [
            'oferta' => $oferta,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/oferta/eliminar/{id}", name="admin_oferta_elim")
     */
    public function elimOferta(Oferta $oferta)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($oferta);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/oferta/afegir", name="admin_oferta_afeg")
     */
    public function afegOferta(Request $request)
    {
        $form = $this->createForm(OfertaType::class)
            ->add('empresa', ChoiceType::class, [
                'mapped'  => false,
                'data_class' => Empresa::class,
                'choices' => $this->buildChoices()
            ]);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $oferta = new Oferta();
            $oferta->setTitol($form->get('titol')->getData());
            $oferta->setDescripcio($form->get('descripcio')->getData());
            $oferta->setDataPub($form->get('data_pub')->getData());
            $oferta->setEmpresa($manager->getRepository(Empresa::class)->find($form->get('empresa')->getData()));

            $manager->persist($oferta);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/admin_oferta/afegir_oferta.html.twig', [
            'form' => $form->createView()
        ]);
    }

    protected function buildChoices()
    {
        $choices = [];
        $empresaObjects = $this->getDoctrine()->getManager()->getRepository(Empresa::class)->findAll();

        foreach ($empresaObjects as $empresaObj){
            $choices[$empresaObj->getNom()] = $empresaObj->getId();
        }

        return $choices;
    }
}
