<?php

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\DocumentType;
use App\Entity\Employees;
use App\Entity\SubArea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        /**
         * Data para las Areas
         */

        $area = new Area();
        $area->setDescription('Direccion General');
        $area->setCreatedAt(new \DateTime());
        $area->setUpdatedAt(new \DateTime());
        $manager->persist($area);

        $area1 = new Area();
        $area1->setDescription('Administracion y RRHH');
        $area1->setCreatedAt(new \DateTime());
        $area1->setUpdatedAt(new \DateTime());
        $manager->persist($area1);

        $area2 = new Area();
        $area2->setDescription('Marketing');
        $area2->setCreatedAt(new \DateTime());
        $area2->setUpdatedAt(new \DateTime());
        $manager->persist($area2);

        $area3 = new Area();
        $area3->setDescription('Produccion');
        $area3->setCreatedAt(new \DateTime());
        $area3->setUpdatedAt(new \DateTime());
        $manager->persist($area3);

        $area4 = new Area();
        $area4->setDescription('Informatica');
        $area4->setCreatedAt(new \DateTime());
        $area4->setUpdatedAt(new \DateTime());
        $manager->persist($area4);

        /**
         * Data para Subareas
         */
        $subarea = new SubArea();
        $subarea->setDescription('Direccion General');
        $subarea->setArea($area);
        $subarea->setCreatedAt(new \DateTime());
        $subarea->setUpdatedAt(new \DateTime());
        $manager->persist($subarea);

        $subarea1 = new SubArea();
        $subarea1->setDescription('Director de Recursos Humanos');
        $subarea1->setArea($area1);
        $subarea1->setCreatedAt(new \DateTime());
        $subarea1->setUpdatedAt(new \DateTime());
        $manager->persist($subarea1);

        $subarea2 = new SubArea();
        $subarea2->setDescription('Tecnico de seleccion de personal');
        $subarea2->setArea($area1);
        $subarea2->setCreatedAt(new \DateTime());
        $subarea2->setUpdatedAt(new \DateTime());
        $manager->persist($subarea2);

        $subarea3 = new SubArea();
        $subarea3->setDescription('Tecnico de formacion');
        $subarea3->setArea($area1);
        $subarea3->setCreatedAt(new \DateTime());
        $subarea3->setUpdatedAt(new \DateTime());
        $manager->persist($subarea3);

        $subarea4 = new SubArea();
        $subarea4->setDescription('Tecnico de relaciones laborales y nominas');
        $subarea4->setArea($area1);
        $subarea4->setCreatedAt(new \DateTime());
        $subarea4->setUpdatedAt(new \DateTime());
        $manager->persist($subarea4);

        $subarea5 = new SubArea();
        $subarea5->setDescription('Tecnico de comunicacion interna');
        $subarea5->setArea($area1);
        $subarea5->setCreatedAt(new \DateTime());
        $subarea5->setUpdatedAt(new \DateTime());
        $manager->persist($subarea5);

        $subarea6 = new SubArea();
        $subarea6->setDescription('Social Media Manager');
        $subarea6->setArea($area2);
        $subarea6->setCreatedAt(new \DateTime());
        $subarea6->setUpdatedAt(new \DateTime());
        $manager->persist($subarea6);

        $subarea7 = new SubArea();
        $subarea7->setDescription('SEO');
        $subarea7->setArea($area2);
        $subarea7->setCreatedAt(new \DateTime());
        $subarea7->setUpdatedAt(new \DateTime());
        $manager->persist($subarea7);

        $subarea8 = new SubArea();
        $subarea8->setDescription('Redactor');
        $subarea8->setArea($area2);
        $subarea8->setCreatedAt(new \DateTime());
        $subarea8->setUpdatedAt(new \DateTime());
        $manager->persist($subarea8);

        $subarea9 = new SubArea();
        $subarea9->setDescription('Diseñador grafico');
        $subarea9->setArea($area2);
        $subarea9->setCreatedAt(new \DateTime());
        $subarea9->setUpdatedAt(new \DateTime());
        $manager->persist($subarea9);

        $subarea10 = new SubArea();
        $subarea10->setDescription('Tecnico de Marketing Digital');
        $subarea10->setArea($area2);
        $subarea10->setCreatedAt(new \DateTime());
        $subarea10->setUpdatedAt(new \DateTime());
        $manager->persist($subarea10);

        $subarea11 = new SubArea();
        $subarea11->setDescription('Jefe de Produccion');
        $subarea11->setArea($area3);
        $subarea11->setCreatedAt(new \DateTime());
        $subarea11->setUpdatedAt(new \DateTime());
        $manager->persist($subarea11);

        $subarea12 = new SubArea();
        $subarea12->setDescription('Personal tecnico especializado');
        $subarea12->setArea($area3);
        $subarea12->setCreatedAt(new \DateTime());
        $subarea12->setUpdatedAt(new \DateTime());
        $manager->persist($subarea12);

        $subarea13 = new SubArea();
        $subarea13->setDescription('Analista de calidad');
        $subarea13->setArea($area3);
        $subarea13->setCreatedAt(new \DateTime());
        $subarea13->setUpdatedAt(new \DateTime());
        $manager->persist($subarea13);

        $subarea14 = new SubArea();
        $subarea14->setDescription('Supervisor de fabrica');
        $subarea14->setArea($area3);
        $subarea14->setCreatedAt(new \DateTime());
        $subarea14->setUpdatedAt(new \DateTime());
        $manager->persist($subarea14);

        $subarea15 = new SubArea();
        $subarea15->setDescription('Desarrollador de sistemas');
        $subarea15->setArea($area4);
        $subarea15->setCreatedAt(new \DateTime());
        $subarea15->setUpdatedAt(new \DateTime());
        $manager->persist($subarea15);

        $subarea16 = new SubArea();
        $subarea16->setDescription('Programador');
        $subarea16->setArea($area4);
        $subarea16->setCreatedAt(new \DateTime());
        $subarea16->setUpdatedAt(new \DateTime());
        $manager->persist($subarea16);

        $subarea17 = new SubArea();
        $subarea17->setDescription('Servicio tecnico');
        $subarea17->setArea($area4);
        $subarea17->setCreatedAt(new \DateTime());
        $subarea17->setUpdatedAt(new \DateTime());
        $manager->persist($subarea17);

        $subarea18 = new SubArea();
        $subarea18->setDescription('Auditor informatico');
        $subarea18->setArea($area4);
        $subarea18->setCreatedAt(new \DateTime());
        $subarea18->setUpdatedAt(new \DateTime());
        $manager->persist($subarea18);

        /**
         * Data Tipo de Identificacion
         */

        $documentType = new DocumentType();
        $documentType->setDescription('Cedula de ciudadania');
        $documentType->setCreatedAt(new \DateTime());
        $documentType->setUpdatedAt(new \DateTime());
        $manager->persist($documentType);

        $documentType1 = new DocumentType();
        $documentType1->setDescription('Registro civil de nacimiento');
        $documentType1->setCreatedAt(new \DateTime());
        $documentType1->setUpdatedAt(new \DateTime());
        $manager->persist($documentType1);

        $documentType2 = new DocumentType();
        $documentType2->setDescription('Tarjeta de identidad');
        $documentType2->setCreatedAt(new \DateTime());
        $documentType2->setUpdatedAt(new \DateTime());
        $manager->persist($documentType2);

        $documentType3 = new DocumentType();
        $documentType3->setDescription('Tarjeta de extranjeria');
        $documentType3->setCreatedAt(new \DateTime());
        $documentType3->setUpdatedAt(new \DateTime());
        $manager->persist($documentType3);

        $documentType4 = new DocumentType();
        $documentType4->setDescription('Cedula de extranjeria');
        $documentType4->setCreatedAt(new \DateTime());
        $documentType4->setUpdatedAt(new \DateTime());
        $manager->persist($documentType4);

        $documentType5 = new DocumentType();
        $documentType5->setDescription('NIT');
        $documentType5->setCreatedAt(new \DateTime());
        $documentType5->setUpdatedAt(new \DateTime());
        $manager->persist($documentType5);

        $documentType6 = new DocumentType();
        $documentType6->setDescription('Pasaporte');
        $documentType6->setCreatedAt(new \DateTime());
        $documentType6->setUpdatedAt(new \DateTime());
        $manager->persist($documentType6);

        $documentType7 = new DocumentType();
        $documentType7->setDescription('Tipo de documento extranjero');
        $documentType7->setCreatedAt(new \DateTime());
        $documentType7->setUpdatedAt(new \DateTime());
        $manager->persist($documentType7);


        /**
         * Data empleados
         */
        $employee = new Employees();
        $employee->setFirstNames('Benjamin');
        $employee->setLastNames('Perez');
        $employee->setDocument('1143327');
        $employee->setArea($area);
        $employee->setDocumentType($documentType);
        $employee->setCreatedAt(new \DateTime());
        $employee->setUpdatedAt(new \DateTime());
        $manager->persist($employee);

        $user = new User();
        $user->setEmail('bperez@hotmail.com');
        $user->setPassword($this->passwordHasher->hashPassword($user,'password'));
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}
