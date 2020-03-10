<?php

namespace App\DataFixtures;

use App\Entity\Candidato;
use App\Entity\Empresa;
use App\Entity\Oferta;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 20; $i++) {
            $empresa = new Empresa();
            $empresa->setLogo('logo' . $i);
            $empresa->setTipus('tipus' . $i);
            $empresa->setCorreu('correu' . $i);
            $empresa->setNom('nom' . $i);

            $oferta = new Oferta();
            $oferta->setDescripcio('descripcio' . $i);
            $oferta->setDataPub(new \DateTime());
            $oferta->setTitol('titol' . $i);
            $oferta->setEmpresa($empresa);

            $candidato = new Candidato();
            $candidato->setNom('nom' . $i);
            $candidato->setCognoms('cognoms' . $i);
            $candidato->setTelefon(mt_rand(600000000, 699999999));
            $candidato->setEstudis('estudis' . $i);
            $candidato->setOferta($oferta);

            $manager->persist($oferta);
            $manager->persist($empresa);
            $manager->persist($candidato);
        }
        $manager->flush();
    }
}
